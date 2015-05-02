@if (!empty($tasks))
	<table class="table table-condensed">
	<thead>
	<tr>
		<th>@lang('view.tasks.label.n')</th>
		<th>@lang('view.tasks.label.billing_period')</th>
		<th>@lang('view.tasks.label.task')</th>
		<th>@lang('view.tasks.label.from')</th>
		<th>@lang('view.tasks.label.to')</th>
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
			{{ date('d.m.Y', $task['bill_from']) }} &mdash; {{ date('d.m.Y', $task['bill_to']) }}
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
