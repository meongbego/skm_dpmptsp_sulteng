<script type="text/javascript">
  $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      startDate: '-365d'
  });
  $('#tablesurvei').dataTable({ //load list
    "lengthMenu": [[25, 50, -1], [25, 50, "All"]] //set here to set lenth list
  });
</script>
