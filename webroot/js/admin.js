function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

$(document).ready(function() {
    $("#results" ).load( "/admin/pages/pagination"); //load initial records

    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        var page = $(this).attr("data-page"); //get page number from link
        $("#results").load("/admin/pages/pagination", {"page":page});

    });
});