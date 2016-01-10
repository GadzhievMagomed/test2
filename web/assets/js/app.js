var reviewsApp;

reviewsApp = angular.module('reviewsApp', []);

reviewsApp.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('[[');
  return $interpolateProvider.endSymbol(']]');
});

reviewsApp.controller('MainCtrl', function($scope, $http) {
  var updateReview;
  $scope.reviews = [];
  $scope.userIp = userIp;
  $scope.sortType = 'publish_date';
  $scope.sortReverse = 'desc';
  $scope.newReviewName = '';
  $scope.newReviewText = '';
  updateReview = function() {
    return $http.post('/ajax/get_reviews').success(function(response) {
      return $scope.reviews = response;
    });
  };
  updateReview();
  $scope.isHaveLike = function(arr, ip) {
    var i, len, like;
    for (i = 0, len = arr.length; i < len; i++) {
      like = arr[i];
      if (like.ip === ip) {
        return true;
      }
    }
    return false;
  };
  $scope.likeAdd = function(id) {
    console.log(id);
    return $http.post('/ajax/add_review_star', {
      'id': id
    }).success(function(response) {
      return updateReview();
    });
  };
  $scope.editSortType = function(column) {
    return $scope.sortType = column;
  };
  $scope.editSortReverse = function(type) {
    return $scope.sortReverse = type;
  };
  return $scope.newReview = function() {
    return $http.post('/ajax/add_review', {
      'name': $scope.newReviewName,
      'text': $scope.newReviewText
    }).success(function(response) {
      return updateReview();
    });
  };
});
