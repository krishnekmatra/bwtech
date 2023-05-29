@foreach($features as $val)
		@foreach(@$val['features'] as $features)
		<div class="col-6 mt-2">
			<div class="form-group mg-b-0">
					<label class="form-label">{{@$features['featureName']['name']}}: <span class="tx-danger">*</span></label>
					@if(@$features['featureName']['feature_type'] == 'text')
								
								@if(@$product_feature_text)
								@foreach($product_feature_text as $value)
								@if($value['features_id'] == $features['featureName']['id'])
								<input type="text" name="multiplefaeturesText[{{$features['featureName']['id']}}]" class="form-control" value="{{$value['value']}}"/>
								@endif

								@endforeach
								@else
								<input type="text" name="multiplefaeturesText[{{$features['featureName']['id']}}]" class="form-control"/>
								@endif
								

							@else

							<select class="form-control" name="multiplefaetures[{{$features['featureName']['id']}}]" >
								<option value="">Select</option>
								@foreach($features['featureName']['FeatureAttributes'] as $attribute)
										@if(in_array($attribute['id'],$product_feature))
										@php $selected = 'selected';
										 @endphp

										@else
										@php $selected = '' @endphp
										@endif
										<option value="{{$attribute['id']}}" {{$selected}}>{{$attribute['name']}}</option>
								@endforeach
							</select>
					@endif
					<span class="text-danger" id="sub_category_feature_id_error"></span>
			</div>
		</div>
		@endforeach

@endforeach