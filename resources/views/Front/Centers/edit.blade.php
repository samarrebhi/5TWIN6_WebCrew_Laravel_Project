<form method="post"  action="{{route('center.update',$center->id)}}">
    @csrf
    @method('PUT')
    <label>Name</label>
    <input type="text" name="name" value="{{$center->name}}"/><br>
    <label>Address</label>
    <input type="text" name="address" value="{{$center->address}}"/><br>
    <label>Description</label>
    <textarea name="description" >{{$center->description}}</textarea><br>
    <label>Phone</label>
    <input type="number" name="phone" value="{{$center->phone}}"/><br>
    <label>Email</label>
    <input type="email" name="email" value="{{$center->email}}"/><br>
<button>Edit Center </button>
</form>