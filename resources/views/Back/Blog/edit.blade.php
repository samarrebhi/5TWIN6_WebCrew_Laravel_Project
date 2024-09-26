@extends('Back/dashboard')
@section('content') 

<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-12">
                        <div class="card-body">
                         

                          <a href="{{ route('admin.listBlog')}}" class="btn btn-sm btn-outline-primary">Aller Vers La Liste</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                  
                        <h5 class="card-header m-0 me-2 pb-3">Edit Your Blog</h5>

                        
                    <form action="{{ route('admin.blog.update',$blog->id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                        <div class="card border-0 shadow-lg"> 
                         <div class="card-body">

                          <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" placeholder="Taper le Titre" 
                            class="form-control @error('titre') is-invalid @enderror " value="{{ old('titre',$blog->titre)}}">
                            @error('titre')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="texte" class="form-label">Text</label>
                            <textarea  name="texte" id="texte" placeholder="Tapez le Texte" 
                            class="form-control @error('texte') is-invalid @enderror ">{{ old('texte',$blog->texte)}}</textarea>
                            @error('texte')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="support" class="form-label">Support</label>
                            <textarea name="support" id="support" placeholder="Tapez les Supports" 
                            class="form-control">{{ old('support',$blog->support)}}</textarea>
                          </div>
                          <div class="mb-3">
                            <label for="image" class="form-label"></label>
                            <input type="file" name="image" class="@error('image') is-invalid @enderror ">
                            @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror

                            <div class="pt-3">
                            @if($blog->image != '' && file_exists(public_path().'/uploads/blogs/'.
                                  $blog->image))
                                  <img src="{{ url('uploads/blogs/'.$blog->image) }}" alt="" height="100" 
                                  width="100" >
                            @endif
                            </div>

                          </div>


                         </div>
                        </div>
                        <button class="btn btn-primary my-4">Mettre à Jour</button>
                    </form>
                        
               
                </div>



                </div>
                </div>
                </div>
@endsection 