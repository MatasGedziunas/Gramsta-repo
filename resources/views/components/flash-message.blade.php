@if(session()->has('message'))
<div style="position: fixed; top:0%"x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
  <p>
    {{session('message')}}
  </p>
</div>
@endif
