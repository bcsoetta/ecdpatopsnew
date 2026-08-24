var base_url = window.location.origin;

$(document).ready(function() {
    
});


function rolecheck($rid, $idm){
    const menuId = $idm;
    const roleId = $rid;

    $.ajax({
        url: base_url+"/vms/admin/changeaccess",
        type: "POST",
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function(){
            document.location.href = base_url+"/vms/admin/roleaccess/"+roleId;
        }
    });
}

function editRole($id, $role) {
    $('#idrole').val($id);
    $('#erole').val($role);
};

function editMenu($id, $menu) {
    $('#idmenu').val($id);
    $('#emenu').val($menu);
};

function editSubMenu($idmn, $id, $title, $mn, $url, $icon, $active) {
    $('#eidsm').val($id);
    $('#etitle').val($title);
    $('#eurl').val($url);
    $('#eicon').val($icon);
    $.ajax({
        type: 'POST',
        url: base_url + "/vms/menu/getMenu",
        data: "id=" + $idmn,
        dataType: "json",
        beforeSend: function () {
            $('#select_menu').html('<img src="' + base_url + '/vms/assets/img/loading2.gif" width="70px;">');
        },
        success: function (data) {
            // select menu
            $('#select_menu').html(
                '<select name="emenu_id" id="emenu_id" class="custom-select">' +
                '<option value="' + $idmn + '" selected>' + $mn + '</option>' +
                $.each(data, function (k, v) { v }) +
                '</select>'
            );
            // active radio button
            if ($active == 1) {
                $('#radio_button').html(
                    '<div class="form-check"><input class="form-check-input" type="radio" name="is_active" id="is_active1" value="1" checked><label class="form-check-label" for="is_active1">Active</label></div ><div class="form-check"><input class="form-check-input" type="radio" name="is_active" id="is_active2" value="0"><label class="form-check-label" for="is_active2">Non-active</label></div>'
                );
            } else {
                $('#radio_button').html(
                    '<div class="form-check"><input class="form-check-input" type="radio" name="is_active" id="is_active1" value="1" ><label class="form-check-label" for="is_active1">Active</label></div ><div class="form-check"><input class="form-check-input" type="radio" name="is_active" id="is_active2" value="0" checked><label class="form-check-label" for="is_active2">Non-active</label></div>'
                );
            }
        }
    });
};