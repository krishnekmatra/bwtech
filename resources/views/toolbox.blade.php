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
                                <div class="toolbox-item toolbox-sort select-box text-dark ml-2">
                                    <select name="filterBy" class="form-control" id="filterBy">
                                        <option value="" selected>Select Filter</option>
                                        <option value="basic" data-hide="advance"   >Basic Filter</option>
                                        <option value="advance"  data-hide="bascic">Advance Filter</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-show select-box mr-0">
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
                                @if($val['featureName']['search_type'] == 'basic')
                                <div class="col-md-3">
                                    <h6>{{$val['featureName']['name']}}</h6>
                                    @if($val['featureName']['FeatureAttributes'])
                                    <ul class="widget-body filter-items item-check mt-1 feature-item">
                                            @foreach($val['featureName']['FeatureAttributes'] as $attribute)
                                            <li class="features" data-id="{{$attribute['id']}}"><a href="javascript:void(0)">{{$attribute['name']}}</a></li>
                                            @endforeach
                                    </ul>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                @endif

                        </div>
                        <div class="row mt-3 advanceDiv" style="display:none">
                            @if(@$features)
                                @foreach($features as $val)
                                @if($val['featureName']['search_type'] == 'advance')
                                <div class="col-md-3">
                                    <h6>{{$val['featureName']['name']}}</h6>
                                    @if($val['featureName']['FeatureAttributes'])
                                    <ul class="widget-body filter-items item-check mt-1 feature-item">
                                            @foreach($val['featureName']['FeatureAttributes'] as $attribute)
                                            <li data-id="{{$attribute['id']}}"><a href="javascript:void(0)">{{$attribute['name']}}</a></li>
                                            @endforeach
                                    </ul>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                                @endif

                        </div>
                        <hr/>
<script type="text/javascript">
   
</script>