@forelse ($tasks as $task)
	<li>{{ $task }}</li>
@empty
	<p>@lang('view.tasks.empty')</p>
@endforelse
