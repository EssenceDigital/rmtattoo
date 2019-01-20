<br>
<h3 style="background-color:#03060d; color:rgb(188, 147, 85); margin-bottom: 10px; padding: 7px; width: 20%;">
  DO NOT REPLY TO THIS MESSAGE.
</h3>
<h3 style="color:#03060d; line-height:10px;">From:</h3>
<p>{{ $messageDetails['name'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Respond to:</h3>
<p>{{ $messageDetails['from'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Phone:</h3>
<p>{{ $messageDetails['phone'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Prefered artist:</h3>
@if ($messageDetails['artist'] != '')
  <p>{{ $messageDetails['artist'] }}</p>
@else
  <p>None</p>
@endif

<h3 style="color:#03060d; line-height:10px;">Description:</h3>
<p>{{ $messageDetails['description'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Size:</h3>
<p>{{ $messageDetails['tattoo_size'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Location:</h3>
<p>{{ $messageDetails['location'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Color preference:</h3>
<p>{{ $messageDetails['color_preference'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Style:</h3>
<p>{{ $messageDetails['tattoo_style'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Budget:</h3>
<p>{{ $messageDetails['budget'] }}</p>

<h3 style="color:#03060d; line-height:10px;">Reference images:</h3>
@if (count($messageDetails['images']) > 0)
  @foreach ($messageDetails['images'] as $image)
    <a href="{{ $image }}">{{ $image }}</a><br>
  @endforeach
@else
  <p>None</p>
@endif
