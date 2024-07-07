@extends('layout.app')

@section('content')

<div class="p-3 max-w-lg mx-auto">
    <h1 class="text-3xl font-semibold text-center my-7">Profile</h1>

    <form action="{{ route('profile.update', $admin->admin_id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        @csrf
        <input onchange="document.getElementById('profileImage').src = window.URL.createObjectURL(this.files[0])" type="file" ref="#" accept="image/*" name="admin_profile" hidden>
        <img id="profileImage" onclick="document.querySelector('input[type=file]').click()" src="{{ asset('images/'.$admin->admin_profile) }}" alt="" class="rounded-full h-24 w-24 object-cover cursor-pointer self-center mt-2">

        <input type="text" value="{{ $admin->name }}" placeholder="Username" class="border p-3 rounded-lg" id="name" name="name" required>
        <input type="email" value="{{ $admin->email }}" placeholder="Email" class="border p-3 rounded-lg" id="email" name="email" required>

        <button type="submit" class="bg-sky-600 text-white rounded-lg p-3 uppercase hover:opacity-95 disabled:opacity-80">Update</button>
    </form>

    <div class="flex justify-between mt-5">
        <form action="{{ route('profile.destroy', $admin->admin_id) }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <button type="button" onclick="openAdminModal()" class="bg-red-600 text-white rounded-lg p-3 uppercase hover:opacity-95 disabled:opacity-80">Delete</button>
        </form>
        <a href="add-admin">
            <button class="bg-green-600 text-white rounded-lg p-3 uppercase hover:opacity-95 disabled:opacity-80">Add User</button>
        </a>
        <a href="#">
            <button class="bg-blue-600 text-white rounded-lg p-3 uppercase hover:opacity-95 disabled:opacity-80">Change Password</button>
        </a>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteAdminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-8 shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this admin?</p>
        <div class="mt-8 flex justify-between space-x-4">
            <button onclick="closeAdminModal()" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Cancel</button>
            <button onclick="document.getElementById('deleteForm').submit();" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Delete</button>
        </div>
    </div>
</div>

@endsection

<script>
function openAdminModal() {
    document.getElementById('deleteAdminModal').classList.remove('hidden');
}

function closeAdminModal() {
    document.getElementById('deleteAdminModal').classList.add('hidden');
}
</script>
