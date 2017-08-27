<script src="/js/jquery.min.js"></script>

<h3>Pages</h3>

<div id="results"><!-- content will be loaded here --></div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#results" ).load( "/admin/pages/pagination"); //load initial records

        //executes code below when user click on pagination links
        $("#results").on( "click", ".pagination a", function (e){
            e.preventDefault();
            var page = $(this).attr("data-page"); //get page number from link
            $("#results").load("/admin/pages/pagination", {"page":page});

        });
    });
</script>

<a href="/admin/pages/add">
    <button class="btn btn-sm btn-success">New Page</button>
</a>
