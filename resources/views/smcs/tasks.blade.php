@if (!empty($tasks))
	<table class="table table-condensed">
	<thead>
	<tr>
		<th>@lang('view.tasks.n')</th>
		<th>@lang('view.tasks.task')</th>
		<th>@lang('view.tasks.from')</th>
		<th>@lang('view.tasks.to')</th>
	</tr>
	</thead>
	<tbody>
@endif
<?php $n = 0; ?>
@forelse ($tasks as $task)
	<tr>
		<td>
			{{ ++$n }}
		</td>
		<td>
			@lang('tasks.type.' . $task['type'])
			@if ($task['is_cummulative'])
				<br>
				<em>@lang('view.tasks.cummulative')</em>
			@endif
		</td>
		<td>
			{{ date('d.m.Y', $task['from']) }}
		</td>
		<td>
			{{ date('d.m.Y', $task['to']) }}
		</td>
	</tr>
@empty
	<p>@lang('view.tasks.empty')</p>
@endforelse
@if (!empty($tasks))
	</tbody>
	</table>
@endif
