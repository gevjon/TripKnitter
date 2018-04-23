function get_sum(total, num){
	return total + num;
}

function euclidean_distance(x,y){
	var sum = 0;
	for (var i = 0; i < x.length; i++){
		sum += Math.pow((x[i]-y[i]),2);
	}
	var distance = Math.sqrt(sum);
	return distance;
}

function find_cluster(point, centroids){
	//centroids is a array which stores all the centroids coordinates
	var cluster;
	var min_dist = Infinity;
	var distance;
	for (var i = 0; i < centroids.length; i++){
		distance = euclidean_distance(point,centroids[i]);
		if (distance < min_dist){
			min_dist = distance;
			cluster = i;
		}
	}
	return cluster;
}

function reset_zero(x){
	var temp = [];
	for (var i = 0; i < x.length; i++){
		temp[i] = 0;
	}
	return temp;
}

function sum_two_array(x,y){
	var sum = [];
	for (var i = 0; i < x.length; i++){
		sum.push(x[i]+y[i]);
	}
	return sum;
}

function ave_array(x,counts){
	var temp = [];
	for (var i = 0; i < x.length; i++){
		temp[i] = x[i]/counts;
	}
	return temp;
}

function assign_cluster(location,centroids){
	var cluster = {}; //store each attraction's corresponding cluster
	//choose initial clusters
	for (var key in location){
		var p = location[key];
		cluster[key] = find_cluster(p,centroids);
	}
	return cluster;
}


function diff(old, new_version){
	var sum = 0;
	for (var i = 0; i < old.length; i++){
		sum += euclidean_distance(old[i],new_version[i]);
	}
	return (sum/(old.length));

}


function k_means(location,centroids){
	//location is an json object of which keys are SID (string), and values are an array of coordinates
	
	//choose initial clusters
	var outcome;
	var cluster = assign_cluster(location,centroids); //store each attraction's corresponding cluster
	// console.log(cluster);
	var isConvergence = false;
	var max_iter = 100;
	var iter = 0;
	while (!isConvergence && iter <= max_iter){
		//Calculate the new centers
		var new_centroids = [];
		var count = [];
		// var new_centroid;
		for (var i = 0; i < centroids.length; i++){
			var new_centroid = reset_zero(centroids[0]);
			count[i] = 0;
			for (var key in location){
				if (cluster[key] == i){
					new_centroid = sum_two_array(new_centroid, location[key]);
					count[i] += 1;
				}
			}
			
			new_centroids.push(ave_array(new_centroid,count[i]));

		}
		// console.log(new_centroids);
		//Reassign all points to the new clusters
		cluster = assign_cluster(location,new_centroids);

		//Teminate condition
		if (diff(centroids,new_centroids) < 0.001){
			isConvergence = true;
		}
		centroids = new_centroids;
		// console.log(centroids);
		iter += 1;
	}
	
	return new_centroids;
}









