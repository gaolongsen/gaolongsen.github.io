

# Three interpretations of the homogenous transformation matrix

In one of the open Classes at Stanford University  - Robotics, a class summarizes these three interpretations adequately: **<mark>Coordinate Representation</mark>** ,**<mark>Coordinate Transformation</mark>**, and **<mark>Point Operator</mark>**. We will explain each of them in the following chapters. 

## 1. Coordinate system representation

Coordinate system representation means that the homogenous transformation matrix can be used to represent a coordinate system. Let's look at the two coordinate systems {A} and {B} as shown below. From the previous article on robot positive kinematics - the homogenous transformation matrix, we know that the relationship between the coordinate system {A} and the coordinate system {B} is

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/0.57v0l453c7k0.webp)

<img src="https://latex.codecogs.com/svg.image?_{}^{A}\textrm{T}_B&space;=&space;\begin{bmatrix}_{}^{A}\textrm{R}_B&space;&&space;p_{B_{org}}^{A}&space;\\0&space;&&space;&space;1\\\end{bmatrix}" title="_{}^{A}\textrm{T}_B = \begin{bmatrix}_{}^{A}\textrm{R}_B & p_{B_{org}}^{A} \\0 & 1\\\end{bmatrix}" />

In the article "Robot Positive Kinematics - Understanding Transformation Matrices", we introduced the rotation matrix $ ^AR_B $ (pose relationship between {A} and {B}) representing the projection of the unit vectors of the three axes of the coordinate system {B} in the coordinate system {A} ( i.e. unit vectors in the three axes of coordinates {B} in the coordinate {A}), and in the article "Robot positive kinematics - Homogenous Transformation Matrices", we also saw that $ p_{B_{org}}^{A} $ (position relationship between {A} and {B}) represents the coordinates of the origin of the coordinate system {B} in the coordinate system {A}.

We all know that if we want to determine a coordinate system uniquely, we must understand the origin point and the axis vector. These two elements are all contained in the above homogenous transformation matrix, so we say that the homogenous  transformation matrix can be used to represent a coordinate system, and $ ^AT_B $ is the representation of the coordinate system {B} in the coordinate system {A}.

## 2. Coordinate system transformation

Coordinate system transformation means that the homogenous transformation matrix can describe how one coordinate system can be transformed to another system by translations and rotations. As an example, the homogenous transformation matrix between two coordinate systems {A} and {B} can be expressed as

<img src="https://latex.codecogs.com/svg.image?^AT_B&space;=&space;\begin{bmatrix}rot_y(\pi/3)&space;&&space;trans(3,3,2)&space;\\0&space;&&space;1&space;\\\end{bmatrix}&space;" title="^AT_B = \begin{bmatrix}rot_y(\pi/3) & trans(3,3,2) \\0 & 1 \\\end{bmatrix} " />

Here, The $ rot_{y}(\pi /4) $ represents the rotation matrix corresponding to the rotation $ \pi/4 $ around the x-axis, and $ trans(3,3,2) $, represents the translation 3,3,2 in the x, y, and z directions. At this point, we can perform some translations and rotations of the coordinate system {A} to coincide with the coordinate system {B} finally. This procedure corresponds to the following diagram.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/1.moa6ge63wrk.webp)

We divide this operation process into two steps:

- [x] Translating the coordinate system {A} along the black vector until it coincides with the coordinate system {C}, we easily know that this translation is $ trans(3,3,2) $;
- [x] Rotating the coordinate system {C} around its y-axis to coincide with the coordinate system {B}, it is easy to know that the amount of this rotation is $ rot_{y}(\pi /3) $

Thus we say that the homogenous transformation matrix can be used to describe the transformation relations of the coordinate system, and $ ^AT_B $ is the coordinate system {A} can be obtained by translation and rotation of the coordinate system {B}. We can describe such transformation as

<img src="https://latex.codecogs.com/svg.image?\{B\}&space;=&space;\{A\}&space;\cdot&space;^AT_B&space;" title="\{B\} = \{A\} \cdot ^AT_B " />
