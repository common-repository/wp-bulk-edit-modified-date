<fieldset class="inline-edit-col-right inline-edit-<?php echo $column_name; ?>">
    <div class="inline-edit-col column-<?php echo $column_name; ?>">
        <label class="inline-edit-group">
            <span class="title" style="width: auto;"></span>
            &nbsp;&nbsp;
        </label>
        <div id="modified-date-form">
            <input type="checkbox" name="update_modified_date" id="update_modified_date" value="1">&nbsp;Set Modified Date To Now
            <button type="button" class="button button-primary" id="set_modified_date_btn">Set</button>
            <span id="bulk_modified_msg" style="display: none;"></span>
        </div>
    </div>
</fieldset>