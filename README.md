#Create a set of Classes that conform to the following Standards#


 - ###Provide an iterable, randomly accessable set of points###
	 + Stream.php
	 + ConstantStream.php
	 
 - ###Store a Basis Time, and Time Interval in each Stream###
 
 - ###Allow for the following operations to be performed on Streams:###
 	 	
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
					 

 - ###In order to 'combine' (Operations Listed Above) two Streams, the following conditions must be met:###
 		
		1. Basis Times for both Streams must be the same
		2. Time Interval for both Streams must be the same 

 - ###Null Values will be handled in the following manner:###
		
		      Addition: null + 10 = 10     --> 10 + null = 10
		   Subtraction: null - 10 = -10    --> 10 - null = 10
		Multiplication: null * 10 = null   --> 10 * null = null
		      Division: null / 10 = null   --> 10 / null = null
					 Average: avg ( null , 10 ) = 10
					 Minimum: min ( null , 10 ) = 10
					 Maximum: max ( null , 10 ) = 10
					 

###TODO###
 - ####[x] Create Constant Point Streams####
 - [ ] Create Linear Interpolation Operation
 
