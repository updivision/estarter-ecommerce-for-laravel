<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Create form
    'add'                 => '新增',
    'back_to_all'         => '回到所有 ',
    'cancel'              => '取消',
    'add_a_new'           => '新增一個 ',

        // Create form - advanced options
        'after_saving'            => '新增後',
        'go_to_the_table_view'    => '回到總表',
        'let_me_add_another_item' => '新增另一個紀錄',
        'edit_the_new_item'       => '編輯這個紀錄',

    // Edit form
    'edit'                 => '編輯',
    'save'                 => '儲存',

    // Revisions
    'revisions'            => '修訂版本',
    'no_revisions'         => '找不到修訂版本',
    'created_this'          => '建立的',
    'changed_the'          => '更改了',
    'restore_this_value'   => '回復這個值',
    'from'                 => '由',
    'to'                   => '到',
    'undo'                 => '回復',
    'revision_restored'    => '成功回復修訂版本',

    // CRUD table view
    'all'                       => '全部 ',
    'in_the_database'           => '數據庫裡',
    'list'                      => '清單',
    'actions'                   => '動作',
    'preview'                   => '預覽',
    'delete'                    => '剛除',
    'admin'                     => '管理員',
    'details_row'               => '這是詳情列。你可以在這裡作出編輯。',
    'details_row_loading_error' => '當載入詳情時遇到錯誤。請重試。',

        // Confirmation messages and bubbles
        'delete_confirm'                              => '你確定要刪除這項紀錄嗎？',
        'delete_confirmation_title'                   => '紀錄已被刪除',
        'delete_confirmation_message'                 => '這項紀錄已成功被刪除。',
        'delete_confirmation_not_title'               => '紀錄未被刪除',
        'delete_confirmation_not_message'             => '嘗試刪除時發生錯誤。這項紀錄或未被成功刪除。',
        'delete_confirmation_not_deleted_title'       => '紀錄未被刪除',
        'delete_confirmation_not_deleted_message'     => '沒有任何事情發生過。你的這項紀錄仍然在此。',

        // DataTables translation
        'emptyTable'     => '數據庫中沒有相關紀錄',
        'info'           => '正在顯示 _TOTAL_ 個紀錄中的 _START_ 至 _END_ 項',
        'infoEmpty'      => '正在顯示 0 個紀錄中的 0 至 0 項',
        'infoFiltered'   => '(自 _TOTAL_ 個紀錄中篩選出來的紀錄)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '每頁 _MENU_ 項紀錄',
        'loadingRecords' => '載入中...',
        'processing'     => '處理中...',
        'search'         => '搜尋: ',
        'zeroRecords'    => '找不到相關紀錄',
        'paginate'       => [
            'first'    => '第一頁',
            'last'     => '最尾一頁',
            'next'     => '下一頁',
            'previous' => '上一頁',
        ],
        'aria' => [
            'sortAscending'  => ': 以由小至大的方式掛列',
            'sortDescending' => ': 以由大至小的方式掛列',
        ],

    // global crud - errors
    'unauthorized_access' => '未經授權的存取 - 您沒有權限瀏覽此頁面。',
    'please_fix' => '請修正以下的錯誤：',

    // global crud - success / error notification bubbles
    'insert_success' => '這項紀錄已成功被新增。',
    'update_success' => '這項紀錄已成功被更新。',

    // CRUD reorder view
    'reorder'                      => '重新排序',
    'reorder_text'                 => '請以拖放 (drag and drop) 的放式重新排序。',
    'reorder_success_title'        => '完成',
    'reorder_success_message'      => '你的排序已被儲存。',
    'reorder_error_title'          => '錯誤',
    'reorder_error_message'        => '你的排序尚未被儲存。',

    // CRUD yes/no
    'yes' => 'Yes',
    'no' => 'No',

    // Fields
    'browse_uploads' => '檢視已上傳的檔案',
    'clear' => '清除',
    'page_link' => '頁面連結',
    'page_link_placeholder' => 'http://example.com/your-desired-page',
    'internal_link' => '內部連結',
    'internal_link_placeholder' => '內部連結短碼，例如: \'admin/page\' (no quotes) for \':url\'',
    'external_link' => '外部連結',
    'choose_file' => '選擇檔案',

    //Table field
    'table_cant_add' => '不能再增加 :entity',
    'table_max_reached' => '已達到 :max 項紀錄的上限',

];
