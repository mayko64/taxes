<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="icon" href="favicon.ico">
		<link rel="shortcut icon" href="favicon.ico">
		
		<title>@lang('view.index.task_list')</title>

		@if (App::environment() == 'local')
			<script src="/js/jquery-2.1.3.js"></script>
			<script src="/js/bootstrap.js"></script>
			<script src="/js/moment.js"></script>
			<script src="/js/bootstrap-datetimepicker.min.js"></script>
			<link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
			<link href="/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
			<link href="/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
		@else
			<script src="/js/jquery-2.1.3.min.js"></script>
			<script src="/js/bootstrap.min.js"></script>
			<script src="/js/moment.min.js"></script>
			<script src="/js/bootstrap-datetimepicker.min.js"></script>
			<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
			<link href="/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
			<link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
		@endif
		
		<script>
			window.SMCS = window.SMCS || {};
			window.SMCS.lang = {
				"group"       : "@lang('view.index.label.group')",
				"current_year": "@lang('view.index.label.current_year')",
				"esv_period"  : "@lang('view.index.label.esv_period')",
				"from"        : "@lang('view.index.label.from')",
				"to"          : "@lang('view.index.label.to')",
				'language'    : "@lang('view.index.label.language')"
			};
		</script>
		<script src="/js/smcs.js?2"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('view.index.task_list')</h1>
					<p>@lang('view.index.description')</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<form method="post">
						<div class="form-group">
							<label for="group">@lang('view.index.label.group')</label>
							<select id="group" name="group" class="form-control">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
							</select>
						</div>
						<div class="form-group">
							<label for="current-year">@lang('view.index.label.current_year')</label>
							<div class="input-group yearpicker">
								<input type="text" id="current-year" name="current_year" class="form-control" size="4" maxlength="4">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="esv-period">@lang('view.index.label.esv_period')</label>
							<select id="esv-period" name="esv_period" class="form-control">
								<option value=""></option>
								<option value="month">@lang('view.index.month')</option>
								<option value="quater">@lang('view.index.quater')</option>
							</select>
						</div>
						<div class="form-group">
							<label for="from">@lang('view.index.label.from')</label>
							<div class="input-group datepicker">
								<input type="text" id="from" name="from" class="form-control" size="4" maxlength="4">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="to">@lang('view.index.label.to')</label>
							<div class="input-group datepicker">
								<input type="text" id="to" name="to" class="form-control" size="4" maxlength="4">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label for="language">@lang('view.index.label.language')</label>
							<select id="language" name="language" class="form-control">
								<option value=""></option>
								<option value="ru">@lang('view.index.ru')</option>
								<option value="ua">@lang('view.index.ua')</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">@lang('view.index.ok')</button>
					</form>
				</div>
				<div class="col-md-8">
					<output id="output"></output>
				</div>
			</div>
		</div>
	</body>
</html>
