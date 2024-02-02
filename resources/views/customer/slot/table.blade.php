<tr>
    <td class="align-middle">1</td>
    <td>
        <select name="dynamicSelect" class="select2" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">Range of month</option>
            <option value="3">Range of days</option>
            <option value="2">Custom date Range</option>
            <option value="4">All week</option>
        </select>
    </td>


    <td>
        <div>
            <select class="select2" name="language" style="width: 100%;">
                @foreach($languages as $key => $language)
                    <option value="{{ $language }}">
                        {{ $key }}
                    </option>
                @endforeach
            </select>
            @error('language')
            <div class="text-danger">{{@$message}}</div>
            @enderror
        </div>
    </td>
    <td>
        <div>
            <div class="row Start">
                <input type="text" class="datetimes form-control"/>
            </div>
        </div>
    </td>
    <td>
        <div>
            <div class="row End">
                <input type="text" class="datetimes form-control" />
            </div>
        </div>
    </td>
    <td><input type="time" class="form-control" value="10:05 AM" /></td>
    <td><input type="time" class="form-control" value="10:05 AM" /></td>
    <td>
        <div>
            <select class="select2" name="is_available" style="width: 100%;">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    </td>

    <td>
        <div>
            <input type="number" name="quantity" class="form-control" required >
        </div>
    </td>
    <td class="align-middle">
            <button type="submit" class="bg-transparent border-0">
                <i class="fas fa-trash text-danger"></i>
            </button>
    </td>
</tr>







let allData = {};

function getAllData() {
let rows = [];

$('tbody tr').each(function() {
let tempData = {};
$(this).find('input, select').each(function() {
let name = $(this).attr('name');
let value = $(this).val();
if (value === "") {
$(this).addClass('customError');
} else {
$(this).removeClass('customError');
}
tempData[name] = value;
});
rows.push(tempData);
});

return rows;
}





let languages = {
"en": "English"
};
let select = document.createElement("select");

$.ajax({
url: '/languages',
method: 'GET',
success: function(data) {
console.log(data);
languages = data;

select.id = "languageSelect";
select.classList.add("form-control");

for (var langCode in languages) {
if (languages.hasOwnProperty(langCode)) {
var option = document.createElement("option");
option.value = langCode;
option.text = languages[langCode];
select.appendChild(option);
}
}

select.setAttribute("name", "language");
},
error: function(xhr, status, error) {

console.error(xhr.responseText);
}
});
