define([], function(){
	var array_merge_recursive = function(arr1, arr2) {

		var idx = '';

		if (arr1 && Object.prototype.toString.call(arr1) === '[object Array]' &&
			arr2 && Object.prototype.toString.call(arr2) === '[object Array]') {
			for (idx in arr2) {
				arr1.push(arr2[idx]);
			}
		} else if ((arr1 && (arr1 instanceof Object)) && (arr2 && (arr2 instanceof Object))) {
			for (idx in arr2) {
				if (idx in arr1) {
					if (typeof arr1[idx] === 'object' && typeof arr2 === 'object') {
						arr1[idx] = array_merge_recursive(arr1[idx], arr2[idx]);
					} else {
						arr1[idx] = arr2[idx];
					}
				} else {
					arr1[idx] = arr2[idx];
				}
			}
		}
		return arr1;
	};

	return array_merge_recursive;
});