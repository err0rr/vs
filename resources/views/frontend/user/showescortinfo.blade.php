<tr>
    <th>{{ trans('common.language') }}</th>
    <td>
    <?php $languages="";
        if(count($user_Language_arr)>0){
            
            foreach($user_Language_arr as $langs){
                $languages .= $langs->name.",";    
            }
        } 
    echo rtrim($languages,',');
    ?>    
    </td>
</tr>
<tr>
    <th>{{ trans('common.service') }}</th>
    <td> 
    <?php $service="";
        if(count($user_Service_arr)>0){
            
            foreach($user_Service_arr as $langs){
                $service .= $langs->name.",";    
            }
        } 
    echo rtrim($service,',');
    ?> 
    </td>
</tr>
<tr>
    <th>{{ trans('common.message') }}</th>
    <td>{{ $user_info_arr->message }}</td>
</tr>
<tr>
    <th>{{ trans('common.canton') }}</th>
    <td>{{ $user_info_arr->canton }}</td>
</tr>
<tr>
    <th>{{ trans('common.region') }}</th>
    <td>{{ $user_info_arr->region }}</td>
</tr>
<tr>
    <th>{{ trans('common.area') }}</th>
    <td>{{ $user_info_arr->area }}</td>
</tr>
<tr>
    <th>{{ trans('common.type') }}</th>
    <td>{{ $user_info_arr->type }}</td>
</tr>
<tr>
    <th>{{ trans('common.nationality') }}</th>
    <td>{{ $user_info_arr->nationality }}</td>
</tr>
<tr>
    <th>{{ trans('common.ethnicity') }}</th>
    <td>{{ $user_info_arr->ethnicity }}</td>
</tr>
<tr>
    <th>{{ trans('common.age') }}</th>
    <td>{{ $user_info_arr->age }}</td>
</tr>
<tr>
    <th>{{ trans('common.weight') }}</th>
    <td>{{ $user_info_arr->weight }}</td>
</tr>
<tr>
    <th>{{ trans('common.height') }}</th>
    <td>{{ $user_info_arr->height }}</td>
</tr>
<tr>
    <th>{{ trans('common.eyes') }}</th>
    <td>{{ $user_info_arr->eyes }}</td>
</tr>
<tr>
    <th>{{ trans('common.hair') }}</th>
    <td>{{ $user_info_arr->hair }}</td>
</tr>
<tr>
    <th>{{ trans('common.shoe_size') }}</th>
    <td>{{ $user_info_arr->shoe_size }}</td>
</tr>
<tr>
    <th>{{ trans('common.breast_size') }}</th>
    <td>{{ $user_info_arr->shoe_size }}</td>
</tr>
<tr>
    <th>{{ trans('common.pubic_hair') }}</th>
    <td>{{ $user_info_arr->shoe_size }}</td>
</tr>
<tr>
    <th>{{ trans('common.appointment') }}</th>
    <td>{{ $user_info_arr->appointment }}</td>
</tr>
<tr>
    <th>{{ trans('common.service_for') }}</th>
    <td>{{ $user_info_arr->service_for }}</td>
</tr>
<tr>
    <th>{{ trans('common.instruction') }}</th>
    <td>{{ $user_info_arr->instruction }}</td>
</tr>
<tr>
    <th>{{ trans('common.minimum_rate') }}</th>
    <td>{{ $user_info_arr->minimum_rate }}</td>
</tr>
<tr>
    <th>{{ trans('common.currency') }}</th>
    <td>{{ $user_info_arr->currency }}</td>
</tr>




