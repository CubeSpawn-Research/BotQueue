<?
/**
 * @package botqueue_job
 * @var string $megaerror
 * @var int $page
 * @var int $per_page
 * @var int $total
 * @var array $jobs
 * @var string $status
 */
?>
<? if ($megaerror): ?>
	<?= Controller::byName('htmltemplate')->renderView('errorbar', array('message' => $megaerror))?>
<? else: ?>
	<?
		echo Controller::byName('browse')->renderView('pagination_info', array(
			'page' => $page,
			'per_page' => $per_page,
			'total' => $total,
			'word' => 'job'
		));
	?>
	<?= Controller::byName('job')->renderView('draw_jobs', array('jobs' => $jobs)); ?>
	<?
	echo Controller::byName('browse')->renderView('pagination', array(
		'page' => $page,
		'per_page' => $per_page,
		'base_url' => "/jobs/{$status}",
		'total' => $total
	));
?>
<? endif ?>