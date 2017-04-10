<!DOCTYPE html>
<meta charset="utf-8">
<html ng-app="todoApp">
<head>
	<title>TO-DO List</title>

	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="public/css/materialize.min.css" media="screen,projection"/>

	<link type="text/css" rel="stylesheet" href="public/css/tasks.css"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>


<body>

	<div class="container" ng-controller="tasksController">
		
		<div class="row">
			<div class="col s12 m6 offset-m3">
				<div class="card">
					
					<div class="card-content white-text blue-grey darken-1">
						<span class="card-title center-align">My Tasks</span>
					</div>
					
					<div class="card-content" style="padding-top: 0px;">

						<!-- Search -->
						<div class="row" ng-show="tasks.length > 0">
							<div class="input-field col s12">
								<i class="material-icons prefix">search</i>
								<input id="icon_prefix" type="text" ng-model="searchTask">
								<label for="icon_prefix">Search tasks...</label>
							</div>
						</div>

						<!-- Header -->
						<div class="row bold" ng-show="tasks.length > 0">
							<div class="col s2">
							</div>

							<div class="col s5">
								Task
							</div>

							<div class="col s5">
								When
							</div>
						</div>

						<!-- Tasks -->
						<task task-object="task" do-and-undo-task="doAndUndoTask(atask)" update-btn-remove-task="updateBtnRemoveTask()" ng-repeat="task in tasks | filter:searchTask"></task>

						<!-- Form to create tasks -->
						<form name="formCreateTask">
							<div class="row">

								<div class="input-field col s12">
									<input id="last_name" type="text" class="validate" ng-model="taskDescription" required>
									<label for="last_name">Insert task...</label>
								</div>
								<div class="col s12 msg-required" ng-show="(!isFormValid && !taskDescription)">
									<p>Type task</p>
								</div>

								<div class="input-field col s12">
									<select ng-model="taskDay" class= "browser-default" required>
										<option value="" disabled selected>Select day</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Saturday</option>
										<option value="Sunday">Sunday</option>
									</select>
								</div>
								<div class="col s12 msg-required" style="margin-top: 5px;" ng-show="(!isFormValid && !taskDay)">
									<p>Select day</p>
								</div>

							</div>

							<div class="row">
								<a class="col s12 waves-effect waves-light btn" ng-click="createTask({description: taskDescription, day: taskDay, finished: false})">Create Task</a>
							</div>
						</form>

						<!-- Btn remove task -->
						<div class="row" ng-show="isAnyTaskSelected()" ng-click="removeTask()">
							<a class="col s12 waves-effect red lighten-2 btn">{{textBtnRemoveTask}}</a>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>


</body>

<!-- Load JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="public/js/angular.min.js"></script>
<script src="public/js/app.js"></script>
<script src="public/js/materialize.min.js"></script>
<script src="controllers/tasksController.js"></script>
<script src="directives/task.js"></script>
<script src="services/tasksApi.js"></script>

</html>