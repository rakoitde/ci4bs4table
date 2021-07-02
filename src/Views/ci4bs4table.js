<script type="text/javascript">

	$(document).ready(function() {



	    $(".checkall").on("click",function() {

			var checked = $(this).prop('checked')
			
			//$(this).parent().text(checked ? "uncheck" : "check")

			$(this).parent().parent().parent().find("._filter_options input:checkbox").each(function() {

				$(this).prop("checked",checked);
			});
	    });


$("._filter_options input:checkbox").prop('checked', true)

		// Avoid dropdown menu close on click inside
		$(".dropdown-menu").click(function(e){
		   e.stopPropagation();
		});

	})

</script>