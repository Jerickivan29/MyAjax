<!DOCTYPE html>
<html>
<head>
    <title>Simple CRUD</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include '../../imports/head.php'; ?>
</head>
<body>
    <h2>Add Student</h2>
    <input type="text" id="name" placeholder="Name">
    <input type="text" id="email" placeholder="Email">
    <input type="text" id="phone" placeholder="Phone">
    <button id="add">Add</button>

    <h2>Student List</h2>
    <table border="1" id="studentTable">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
        </thead>
        <tbody></tbody>
    </table>

<script>
$(document).ready(function(){
    function loadData(){
        $.ajax({
            type: "POST",
            url: "code.php",
            data: { action: "read" },
            success: function(response){
                $("#studentTable tbody").html(response);
            }
        });
    }

    loadData(); // Load on page start

    $("#add").click(function(){
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                action: "create",
                name: $("#name").val(),
                email: $("#email").val(),
                phone: $("#phone").val()
            },
            success: function(msg){
                alert(msg);
                loadData();
            }
        });
    });

    $(document).on("click", ".update", function(){
        let row = $(this).closest("tr");
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                action: "update",
                id: $(this).data("id"),
                name: row.find(".name").text(),
                email: row.find(".email").text(),
                phone: row.find(".phone").text()
            },
            success: function(msg){
                alert(msg);
                loadData();
            }
        });
    });

    $(document).on("click", ".delete", function(){
        if(confirm("Are you sure?")){
            $.ajax({
                type: "POST",
                url: "code.php",
                data: { action: "delete", id: $(this).data("id") },
                success: function(msg){
                    alert(msg);
                    loadData();
                }
            });
        }
    });
});
</script>
</body>
</html>
