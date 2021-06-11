<script type="text/javascript">

    $(document).ready(function() {

        // check all funktionality in dropdown filters
        $(".checkall").on("click",function() {

            var checked = $(this).prop('checked')

            $(this).parent().parent().find(".checklabel").text(checked ? "Uncheck all" : "Check all")

            $(this).parent().parent().parent().find("._filter_options input:checkbox").each(function() {

                $(this).prop("checked",checked);

            });

        });

        // Avoid dropdown menu close on click inside
        $(".dropdown-menu").click(function(e){
            e.stopPropagation();
        });

    })

</script>