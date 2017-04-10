todoApp.controller('tasksController', ['$scope', '$http', 'tasksApi', function($scope, $http, tasksApi) {

    $scope.tasks = [];
    tasksApi.getTasks.then(function(res){
        $scope.tasks = res.data;
    }, function(error){
        console.log(error);
    });

    $scope.tasksCandidatesToRemove = [];
    $scope.isFormValid = true;
    $scope.textBtnRemoveTask = 'Remove task';

    /*
        Do and Undo a task
        Insert or remove task into the array tasksCandidatesToRemove
        tasksCandidatesToRemove contains the tasks that are to be removed
    */
    $scope.doAndUndoTask = function(task){
    	task.finished = !task.finished;
    	$scope.updateBtnRemoveTask();
        $scope.isFormValid = true;

        var id = parseInt(task.id);

        if(task.finished){
            if ($scope.tasksCandidatesToRemove.indexOf(id) === -1) {
                $scope.tasksCandidatesToRemove.push(id);
            }

        }
        else{
            var index = $scope.tasksCandidatesToRemove.indexOf(id);
            if (index > -1) {
                $scope.tasksCandidatesToRemove.splice(index, 1);
            }
        }
    };

    /*
        Create a task
        Validates the form before creation.
    */
    $scope.createTask = function(task){

        if(!$scope.formCreateTask.$valid){
            $scope.isFormValid = false;
            return;
        }
        $scope.isFormValid = true;
        task.finished = 0;

        tasksApi.saveTask(task).then(function(res){
            $scope.tasks.push(res.data);
            $scope.taskDescription = '';
            $scope.taskDay = '';
        });
    };


    /*
        Remove task(s)
    */
    $scope.removeTask = function(){
        $scope.isFormValid = true;
        tasksApi.removeTasks($scope.tasksCandidatesToRemove).then(function(res){
            $scope.tasks = res.data;
            $scope.tasksCandidatesToRemove = [];
        });
    };


    /*
        Helper to check if some task is selected
    */
    $scope.isAnyTaskSelected = function(){
        if($scope.tasks){
            var someTaskIsSelected = false;
            for(var i=0; i < $scope.tasks.length; i++){
                if($scope.tasks[i].finished){
                    someTaskIsSelected = true;
                    break;
                }
            }
            return someTaskIsSelected;
        }
    };


    /*
        Update the button "Remove Task" with the appropriate text
        If only one task is selected, button text is "Remove Task"
        If more than one task is selected, button text is "Remove Tasks"
    */
    $scope.updateBtnRemoveTask = function(){
    	var num = 0;
    	for(var i=0; i < $scope.tasks.length; i++){
    		if($scope.tasks[i].finished){
    			num++;
    		}
    	}
    	
    	if(num > 1)
    		$scope.textBtnRemoveTask = 'Remove tasks';
    	else
    		$scope.textBtnRemoveTask = 'Remove task';
    };

}]);