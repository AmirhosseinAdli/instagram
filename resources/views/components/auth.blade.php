<form action="{{  $route  }}" method="{{  $method  }}">
    @csrf
    @foreach($inputs as $key => $input)
        <div class="form-group">
            <input type="{{  $input['type']  }}" class="form-control" name="{{  $input['name']  }}" placeholder="{{  __($input['placeholder'])  }}">
        </div>
        @endforeach
    <button type="submit" class="btn btn-primary btn-block">{{  __($button)  }}</button>

</form>
