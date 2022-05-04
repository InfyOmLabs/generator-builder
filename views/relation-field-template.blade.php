<td class="drag-handler">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-grip-vertical"
        viewBox="0 0 16 16">
        <path
            d="M7 2a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 5a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 3a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
    </svg>
</td>
<td style="vertical-align: middle">
    <select class="form-control drdRelationType" style="width: 100%">
        <option value="1t1">One to One</option>
        <option value="1tm">One to Many</option>
        <option value="mt1">Many to One</option>
        <option value="mtm">Many to Many</option>
    </select>

    <input type="text" class="form-control foreignTable txtForeignTable" style="display: none"
        placeholder="Custom Table Name" />
</td>
<td style="vertical-align: middle">
    <input type="text" required class="form-control txtForeignModel" />
</td>
<td style="vertical-align: middle">
    <input type="text" style="width: 100%" class="form-control txtForeignKey" />
</td>
<td style="vertical-align: middle">
    <input type="text" class="form-control txtLocalKey" />
</td>
<td style="text-align: center;vertical-align: middle">
    <i onclick="removeItem(this)" class="remove fa fa-trash-o" style="cursor: pointer;font-size: 20px;color: red"></i>
</td>
