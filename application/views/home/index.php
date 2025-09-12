<h2>Item List</h2>
<button id="btnAdd" class="btn btn-success mb-3">Add New Item</button>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th width="220">Action</th>
    </tr>
    </thead>
    <tbody id="itemTable"></tbody>
</table>

<div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Item Detail</h5>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p><strong>Title:</strong> <span id="showTitle"></span></p>
        <p><strong>Description:</strong> <span id="showDescription"></span></p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="itemForm">
                <div class="modal-header">
                    <h5 class="modal-title">Item</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="itemId">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const API_URL = "<?= site_url('api/v1/items') ?>";

    $(document).ready(function() {
        loadItems();
    });

    // ==================== AJAX Request ====================
    function apiRequest(method, endpoint = "", data = null, onSuccess = null) {
        $.ajax({
            url: API_URL + endpoint,
            type: method,
            data: data ? JSON.stringify(data) : null,
            contentType: "application/json",
            beforeSend: function() {
                $("#loading-spinner").show();
            },
            complete: function() {
                $("#loading-spinner").hide();
            },
            success: function(res) {
                if (onSuccess) onSuccess(res);
            },
            error: function(xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    }

    // ==================== CRUD ====================
    // Load items
    function loadItems() {
        apiRequest("GET", "", null, function(res) {
            let rows = "";
            if (res.status) {
                res.data.forEach(item => {
                    rows += `
                    <tr>
                        <td>${item.title}</td>
                        <td>${item.description ?? ''}</td>
                        <td>
                            <button class="btn btn-info btn-sm showBtn" data-id="${item.id}">Show</button>
                            <button class="btn btn-sm btn-primary btnEdit" data-id="${item.id}">Edit</button>
                            <button class="btn btn-sm btn-danger btnDelete" data-id="${item.id}">Delete</button>
                        </td>
                    </tr>`;
                });
            }
            $("#itemTable").html(rows);
        });
    }

    // Add new
    $("#btnAdd").click(function() {
        $("#itemId").val('');
        $("#title").val('');
        $("#description").val('');
        $("#itemModal").modal('show');
    });

    // Show item
    $(document).on("click", ".showBtn", function() {
        const id = $(this).data("id");
        apiRequest("GET", "/" + id, null, function(res) {
            if (res.status) {
                $("#showTitle").text(res.data.title);
                $("#showDescription").text(res.data.description);
                $("#showModal").modal("show");
            }
        });
    });

    // Save (create/update)
    $("#itemForm").submit(function(e) {
        e.preventDefault();
        let id = $("#itemId").val();
        let data = {
            title: $("#title").val(),
            description: $("#description").val()
        };

        if (id) {
            apiRequest("PUT", "/" + id, data, function() {
                $("#itemModal").modal('hide');
                loadItems();
            });
        } else {
            apiRequest("POST", "", data, function() {
                $("#itemModal").modal('hide');
                loadItems();
            });
        }
    });

    // Edit
    $(document).on("click", ".btnEdit", function() {
        let id = $(this).data("id");
        apiRequest("GET", "/" + id, null, function(res) {
            if (res.status) {
                $("#itemId").val(res.data.id);
                $("#title").val(res.data.title);
                $("#description").val(res.data.description);
                $("#itemModal").modal('show');
            }
        });
    });

    // Delete
    $(document).on("click", ".btnDelete", function() {
        if (!confirm("Are you sure?")) return;
        let id = $(this).data("id");
        apiRequest("DELETE", "/" + id, null, function() {
            loadItems();
        });
    });
</script>
