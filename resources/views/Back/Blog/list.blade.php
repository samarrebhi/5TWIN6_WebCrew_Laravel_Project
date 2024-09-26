@extends('Back/dashboard')
@section('content') 

<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Félicitations ! 🌿</h5>
                          <p class="mb-4">
                          Vous avez contribué à réduire <span class="fw-bold">72 % </span> de déchets supplémentaires aujourd'hui. 
                          Découvrez votre nouveau badge de recyclage dans votre profil."
                            
                          </p>

                          <a href="{{ route('admin.createBlog')}}" class="btn btn-sm btn-outline-primary">Ajouter </a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../back/assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @if(Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
                @endif
                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                  
                        <h5 class="card-header m-0 me-2 pb-3">Blogs</h5>
                        <!-- <div class="card border-0 shadow-lg">
                            <div class="card-body"> -->
                        <table class="table table-striped table-hover mx-auto col-lg-12" style="width: 80%;">
                        <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Texte</th>
                                <th>Support</th>
                                <th>Action</th>

                            </tr>
                            
                            @if($blogs->isNotEmpty())
                            @foreach ( $blogs as $blog )
                            <tr valign="middle">
                                <td>{{ $blog->id }}</td>
                                <td>
                                  @if($blog->image != '' && file_exists(public_path().'/uploads/blogs/'.
                                  $blog->image))
                                  <img src="{{ url('uploads/blogs/'.$blog->image) }}" alt="" height="40" 
                                  width="40" class="rounded-circle">
                                  @else
                                  <img src="{{ url('back/assets/img/no-image.jpg') }}" alt="" height="40" 
                                  width="40" class="rounded-circle">
                                  @endif
                                </td>
                                <td>{{ $blog->titre }}</td>
                                <td>{{ $blog->texte }}</td>
                                <td>{{ $blog->support }}</td>
                                <td>
                                    <a href="{{ route('admin.blog.edit',$blog->id) }}" class="btn btn-primary btn-sm">Modifier</a>
                                    <a href="#" onclick="deleteBlog({{ $blog->id }})" class="btn btn-danger btn-sm">Supprimer</a>
                                    <form id="blog-edit-action-{{ $blog->id }}" action="{{ route('admin.blog.destroy' ,$blog->id) }}" method="post">
                                      @csrf
                                      @method('delete')
                                    </form>  
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td colspan="6" class="text-center">Aucun blog trouvé</td>
                            </tr>
                            @endif
                        </table>
               
                        <div class="mt-3">
                  {{ $blogs->links() }}
                </div>
                </div>

                


                </div>
                </div>
                </div>
@endsection 

<script>
  function deleteBlog (id){
    if(confirm('Voulez-vous supprimer ce blog ?')){
      document.getElementById('blog-edit-action-'+id).submit();
    }
  }
</script>