<?php
function has_permission($permission)
{
    $CI =& get_instance();

    $permissions = $CI->session->userdata('permissions');

    if (!$permissions) return false;

    return in_array($permission, $permissions);
}


function has_any_permission($permissions = [])
{
    $CI =& get_instance();

    $user_permissions = $CI->session->userdata('permissions');

    if (!$user_permissions || empty($permissions)) {
        return false;
    }

    foreach ($permissions as $perm) {
        if (in_array($perm, $user_permissions)) {
            return true; // ✅ found at least one
        }
    }

    return false; // ❌ none matched
}