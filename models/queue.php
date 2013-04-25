<?
  /*
    This file is part of BotQueue.

    BotQueue is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    BotQueue is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with BotQueue.  If not, see <http://www.gnu.org/licenses/>.
  */

	class Queue extends Model
	{
		public function __construct($id = null)
		{
			parent::__construct($id, "queues");
		}
		
		public function getAPIData()
		{
			$d = array();
			$d['id'] = $this->id;
			$d['name'] = $this->getName();
			
			return $d;
		}
			
		public function canAdd()
		{
			return $this->isMine();
		}
		
		public function isMine()
		{
			return (User::$me->id == $this->get('user_id'));
		}	

		public function getName()
		{
			return $this->get('name');
		}

		public function getUser()
		{
			return new User($this->get('user_id'));
		}
		
		public function getUrl()
		{
			return "/queue:" . $this->id;
		}
		
		public function getJobs($status = null, $sortField = 'user_sort', $sortOrder = 'ASC')
		{
			if ($status !== null)
				$statusSql = " AND status = '".db()->escape($status)."'";
				
			$sql = "
				SELECT id
				FROM jobs
				WHERE queue_id = '".db()->escape($this->id)."'
					{$statusSql}
				ORDER BY {$sortField} {$sortOrder}
			";
			return new Collection($sql, array('Job' => 'id'));
		}
		
		public function findNewJob($bot, $can_slice = true)
		{
			if (!$can_slice)
				$sliceSql = " AND file_id > 0 ";
				
			$sql = "
				SELECT id
				FROM jobs
				WHERE queue_id = '{$this->id}'
					AND status = 'available'
					$sliceSql
				ORDER BY user_sort ASC
			";
			$job_id = db()->getValue($sql);

			return new Job($job_id);
		}
		
		public function getActiveJobs($sortField = 'user_sort', $sortOrder = 'ASC')
		{
			$sql = "
				SELECT id
				FROM jobs
				WHERE queue_id = '".db()->escape($this->id)."'
					AND status IN ('available', 'taken')
				ORDER BY {$sortField} {$sortOrder}
			";
			return new Collection($sql, array('Job' => 'id'));			
		}
		
		public function getBots()
		{
		  $sql = "
		    SELECT id
		    FROM bots
		    WHERE queue_id = '".db()->escape($this->id)."'
		    ORDER BY last_seen DESC
		  ";
		  
		  return new Collection($sql, array('Bot' => 'id'));
		}
		
		public function addFile($file, $qty = 1)
		{
		  if ($file->isGcode())
		    return $this->addGCodeFile($file, $qty);
		  elseif ($file->is3DModel())
		    return $this->add3DModelFile($file, $qty);
		}
		
		public function addGCodeFile($file, $qty = 1)
		{
			$jobs = array();
			
			for ($i=0; $i<$qty; $i++)
			{
				$sort = db()->getValue("SELECT max(id)+1 FROM jobs");
				
				$job = new Job();
				$job->set('user_id', User::$me->id);
				$job->set('queue_id', $this->id);
				$job->set('source_file_id', $file->id);
				$job->set('file_id', $file->id);
				$job->set('name', $file->get('path'));
				$job->set('status', 'available');
				$job->set('created_time', date("Y-m-d H:i:s"));
				$job->set('user_sort', $sort);
				$job->save();

				$jobs[] = $job;
			}
			
			return $jobs;
		}

		public function add3DModelFile($file, $qty = 1)
		{
			$jobs = array();
			
			for ($i=0; $i<$qty; $i++)
			{
				$sort = db()->getValue("SELECT max(id)+1 FROM jobs");
				
				$job = new Job();
				$job->set('user_id', User::$me->id);
				$job->set('queue_id', $this->id);
				$job->set('source_file_id', $file->id);
				$job->set('name', $file->get('path'));
				$job->set('status', 'available');
				$job->set('created_time', date("Y-m-d H:i:s"));
				$job->set('user_sort', $sort);
				$job->save();

				$jobs[] = $job;
			}
			
			return $jobs;
		}
		
		public function getStats()
		{
			$sql = "
				SELECT status, count(status) as cnt
				FROM jobs
				WHERE queue_id = ". db()->escape($this->id)."
				GROUP BY status
			";

			$data = array();
			$stats = db()->getArray($sql);
			if (!empty($stats))
			{
				//load up our stats
				foreach ($stats AS $row)
				{
					$data[$row['status']] = $row['cnt'];
					$data['total'] += $row['cnt'];
				}
				
				//calculate percentages
				foreach ($stats AS $row)
					$data[$row['status'] . '_pct'] = ($row['cnt'] / $data['total']) * 100;
			}
			
			//pull in our time based stats.
			$sql = "
				SELECT sum(unix_timestamp(taken_time) - unix_timestamp(created_time)) as wait, sum(unix_timestamp(finished_time) - unix_timestamp(taken_time)) as runtime, sum(unix_timestamp(finished_time) - unix_timestamp(created_time)) as total
				FROM jobs
				WHERE status = 'complete'
					AND queue_id = ". db()->escape($this->id) ."
			";

			$stats = db()->getArray($sql);
			$data['total_waittime'] = (int)$stats[0]['wait'];
			$data['total_time'] = (int)$stats[0]['total'];

      //pull in our runtime stats
      $sql = "SELECT sum(unix_timestamp(end_date) - unix_timestamp(start_date)) FROM job_clock WHERE status != 'working' AND queue_id = " . db()->escape($this->id);
			$data['total_runtime'] = (int)db()->getValue($sql);

			if ($data['total'] > 0)
			{
  			$data['avg_waittime'] = $data['total_waittime'] / $data['total'];
  			$data['avg_runtime'] = $data['total_runtime'] / $data['total'];
  			$data['avg_time'] = $data['total_time'] / $data['total'];			  
			}
			else
			{
			  $data['avg_waittime'] = 0;
  			$data['avg_runtime'] = 0;
  			$data['avg_time'] = 0;
			}

			return $data;
		}
		
		public function getErrorLog()
		{
		  $sql = "
		    SELECT id
		    FROM error_log
		    WHERE queue_id = '". db()->escape($this->id) ."'
		    ORDER BY error_date DESC
		  ";
		  
		  return new Collection($sql, array('ErrorLog' => 'id'));
		}	
		
		public function flush()
		{
		  $sql = "
		    DELETE FROM jobs
		    WHERE queue_id = ". (int)$this->id ."
		    AND status = 'available'
		  ";
		  db()->execute($sql);
		}

		public function delete()
		{
		  $sql = "
		    DELETE FROM jobs
		    WHERE queue_id = ". (int)$this->id ."
		  ";
		  db()->execute($sql);

		  $sql = "
		    DELETE FROM error_log
		    WHERE queue_id = ". (int)$this->id ."
		  ";
		  db()->execute($sql);
		  
		  parent::delete();
		}
	}
?>
