  <nav class="toolbox sticky-toolbox sticky-content fix-top">
                            <div class="toolbox-left">
                                <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                    btn-icon-left d-block d-lg-none"><i
                                        class="w-icon-category"></i><span>Filters</span></a>
                                <div class="toolbox-item toolbox-sort select-box text-dark">
                                    <label>Sort By :</label>
                                    <select name="orderby" class="form-control" id="orderby">
                                        
                                        <option value="created_at" data-order="desc"  selected>Sort by latest</option>
                                        <option value="mrp" data-order="asc">Sort by price: low to high</option>
                                        <option value="mrp" data-order="desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                                @if($filter == true)
                                <div class="toolbox-item toolbox-sort select-box text-dark ml-2">
                                    <select name="filterBy" class="form-control" id="filterBy">
                                        <option value="" selected>Select Filter</option>
                                        <option value="basic" data-hide="advance"   >Basic Filter</option>
                                        <option value="advance"  data-hide="bascic">Advance Filter</option>
                                        
                                    </select>
                                </div>
                                @endif
                            </div>
                            <div class="toolbox-right">
                                 <div class="toolbox-item toolbox-show select-box mr-0">
                                        <a class="select-allhref"><input type="checkbox" name="selectmultipleproduct" class="selectmultipleproduct"><label>Select All</label></a>
                                    @auth
                                                <a href="javascript:void(0)"
                                                    class="addmultipleProduct btn btn-dark btn-rounded mb-2 mb-lg-0  Catalogue-btn">Add To Catalogue &nbsp;&nbsp;</a>
                                                @else
                                                        <a href="{{url('login')}}"
                                                    class="btn btn-dark btn-rounded sign-in mb-2 mb-lg-0  Catalogue-btn">Add To Catalogue &nbsp;&nbsp;</a>
                                                @endauth
                                </div>
                                <div class="toolbox-item toolbox-show select-box   ml-2">
                                    <select name="limit_product" id="limit_product" class="form-control">
                                        <option value="10" selected="selected">Show 10</option>
                                        <option value="20">Show 20</option>
                                        <option value="30">Show 30</option>
                                    </select>
                                </div>
                                
                            </div>
                        </nav>

                        <div class="row mb-4 basicDiv" style="display:none">
                            
                            @if(@$features)
                                @foreach($features as $val)
                                 @if(count($val['featureName']['FeatureAttributes'])>0)
                                @if($val['featureName']['search_type'] == 'basic')
                                <div class="col-md-4 widget widget-collapsible mt-2">
                                    <h6 class="widget-title collapsed">{{$val['featureName']['name']}}</h6>
                                    @if($val['featureName']['FeatureAttributes'])
                                    <ul class="widget-body filter-items item-check mt-1 feature-item">
                                            @foreach($val['featureName']['FeatureAttributes'] as $attribute)
                                            <li class="{{$val['featureName']['slug']}}" data-id="{{$attribute['id']}}" id="{{$attribute['id']}}"><a href="javascript:void(0)">{{$attribute['name']}}</a></li>
                                            @endforeach
                                    </ul>
                                    @endif
                                </div>
                                @endif
                                @endif
                                @endforeach
                                @endif

                        </div>
                        <div class="row mt-3 advanceDiv" style="display:none">
                            @if(@$features)

                                @foreach($features as $val)
                                @if($val['featureName']['search_type'] == 'advance')
                                <div class="col-md-4 widget widget-collapsible mt-2">
                                    <h6 class="widget-title collapsed">{{$val['featureName']['name']}}</h6>
                                    @if($val['featureName']['FeatureAttributes'])
                                    <ul class="widget-body filter-items item-check mt-1 feature-item">
                                            @foreach($val['featureName']['FeatureAttributes'] as $attribute)
                        <li data-id="{{$attribute['id']}}" id="{{$attribute['id']}}" class="{{$val['featureName']['slug']}}" ><a href="javascript:void(0)">{{$attribute['name']}}</a></li>
                                            @endforeach
                                    </ul>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                @endif

                        </div>
                        <hr/>
