reviewsApp = angular.module('reviewsApp', [])

reviewsApp.config( ($interpolateProvider) ->
  $interpolateProvider.startSymbol('[[');
  $interpolateProvider.endSymbol(']]');

)


reviewsApp.controller('MainCtrl', ($scope, $http) ->

  $scope.reviews = []
  $scope.userIp = userIp;
  $scope.sortType = 'publish_date';
  $scope.sortReverse = 'desc';

  $scope.newReviewName = '';
  $scope.newReviewText = '';


  updateReview = () ->
    $http.post('/ajax/get_reviews').success((response) ->
      $scope.reviews = response
    )


  updateReview()

  $scope.isHaveLike = (arr, ip) ->
    for like in arr
      if like.ip == ip
        return true

    return false


  $scope.likeAdd = (id) ->
    console.log(id)
    $http.post('/ajax/add_review_star', {'id': id}).success((response) ->

      updateReview()

    )

  $scope.editSortType = (column) ->
    $scope.sortType = column

  $scope.editSortReverse = (type) ->
    $scope.sortReverse = type


  $scope.newReview = () ->
    $http.post('/ajax/add_review', {'name': $scope.newReviewName, 'text': $scope.newReviewText}).success((response) ->

      updateReview()

    )








)


