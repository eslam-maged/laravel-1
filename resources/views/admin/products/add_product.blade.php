@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product</a> </div>
    <h1>Products</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/add-product') }}" name="add_product" id="add_product" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                  <label class="control-label">Under Category</label>
                  <div class="controls">
                    <select class="span11" name="category_id" id="category_id">
                      @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
              <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" class="span11" name="name" id="name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea class="span11" name="description" id="description"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Code</label>
                <div class="controls">
                  <input type="text" class="span11" name="code" id="code">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Color</label>
                <div class="controls">
                  <input type="text" class="span11" name="color" id="color">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Price</label>
                <div class="controls">
                  <input type="text" class="span11" name="price" id="price">
                </div>
              </div>
              <div class="control-group">
                  <label class="control-label">Image</label>
                  <div class="controls">
                      <input type="file" name="image" id="image" />
                  </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add Product" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>

@endsection