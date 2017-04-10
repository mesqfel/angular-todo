todoApp.directive("task", function() {
   return {
       restrict: 'E',
       templateUrl: 'directives/task.html',
       replace: true,
       scope: {
           taskObject: "=",
           doAndUndoTask: "&",
           updateBtnRemoveTask: "&"
       }
   };
});