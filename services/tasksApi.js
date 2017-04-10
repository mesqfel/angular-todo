angular.module('todoApp').factory('tasksApi', function($http){

	var _getTasks = $http.get('http://localhost:3412/tasks');
	
	var _saveTask = function(task){
		return $http.post('http://localhost:3412/task/create', task);
	};

	var _removeTasks = function(tasks){
		return $http.delete('http://localhost:3412/task/multidelete/'+JSON.stringify(tasks));
	};

	return {
		getTasks : _getTasks, 
		saveTask : _saveTask,
		removeTasks: _removeTasks
	};
});