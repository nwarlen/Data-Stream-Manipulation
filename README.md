===Create a set of Classes that conform to the following Standards===

 - Provide an iterable, randomly accessable set of points
 	 + Stream.php ( Uses Point.php)
 - Store a Basis Time, and Time Interval in each Stream
 - Allow for the following operations to be performed on Streams:
 	 	
		1. Addition
		2. Subtraction
		3. Multiplication
		4. Division
		5. Average
		6. Minimum
		7. Maximum
		

		Example: 
		
			a->add(b) =>
		        A     B     C
			     |0|   |1|   |1|
			     |1| + |2| = |3|
			     |2|   |3|   |5|
					 

 - In order to 'combine' (Operations Listed Above) two Streams, the following conditions must be met:
 		
		1. Basis Times for both Streams must be the same
		2. Time Interval for both Streams must be the same 

