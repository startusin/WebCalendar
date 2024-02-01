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
