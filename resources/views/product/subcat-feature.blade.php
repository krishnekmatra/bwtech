@foreach($features as $val)
		@foreach(@$val['features'] as $features)
		<div class="col-6 mt-2">
			<div class="form-group mg-b-0">
					<label class="form-label">{{@$features['featureName']['name']}}: <span class="tx-danger">*</span></label>
					@if(@$features['featureName']['feature_type'] == 'text')
							<input type="text" name="multiplefaeturesText[{{$features['featureName']['id']}}]" class="form-control"/>
							@else

							<select class="form-control" name="multiplefaetures[{{$features['featureName']['id']}}]">
								<option>Select</option>
								@foreach($features['featureName']['FeatureAttributes'] as $attribute)
										<option value="{{$attribute['id']}}">{{$attribute['name']}}</option>
								@endforeach
							</select>
					@endif
					<span class="text-danger" id="sub_category_feature_id_error"></span>
			</div>
		</div>
		@endforeach

@endforeach