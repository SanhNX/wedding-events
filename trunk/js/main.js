var mapController;
var placeController;
var eventDispatcher;
var REQUEST_TIMEOUT = 120000;


$(function () {
    var mapOption = {
        center:new google.maps.LatLng(10.7869580,106.70489430),
        zoom:13,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    mapController = new MapController("mapsSource",mapOption);
    eventDispatcher = new EventDispatcher();
    placeController = new PlaceController();


    var callback = function(results,status) {
        var modelType;
        var dto = {};
        if(results.statuscode){
            results.status =  results.statuscode;
            dto =  results.results.places;
            modelType = 1; //MODEL_TYPE;
        }else{
            results.status =  status;
            dto =  results;
            modelType = 0;
        }
        if (results.status == google.maps.places.PlacesServiceStatus.OK) {
            placeController.createModel(dto,modelType);
            placeController.view.createPlaceList(placeController.model);
            mapController.createMarkerList(placeController.model);
        }
    }

/*    ajax.post({
        url : "http://10.88.66.60:8080/recommendation-web-service/places/api/",
        param : {
            api : '203'
        },
        success: callback,
        failure : callback
    });*/

    var request = {
        location: mapController.mapOption.center,
        radius: '10000',
        query : 'cafe'
    };
    mapController.service.textSearch(request, callback);
});