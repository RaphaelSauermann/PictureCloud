<!-- <h2>Map</h2> -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Map</button> -->

<div class="modal fade bd-example-modal-lg" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="mapid"></div>
      <!-- test -->
    </div>
  </div>
</div>

<script type="text/javascript">
$('#mapModal').modal('show');
createMap();

addMarker(48.210033, 16.363449, "Foto 1");
// $('#mapModal').on('show.bs.modal', function(){
//   setTimeout(function() {
//     map.invalidateSize();
//   }, 10);
// });
</script>
