<form method="post" action="{{route('center.store')}}">
    @csrf
    <label>Name</label>
    <input type="text" name="name"/><br>
    <label>Address</label>
    <input type="text" name="address"/><br>
    <label>Description</label>
    <textarea name="description"></textarea><br>
    <label>Phone</label>
    <input type="number" name="phone"/><br>
    <label>Email</label>
    <input type="email" name="email"/><br>
<button>Add Center </button>
</form>