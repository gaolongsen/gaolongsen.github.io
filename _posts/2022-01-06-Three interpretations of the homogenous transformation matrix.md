

# Three interpretations of the homogenous transformation matrix

In one of the open Classes at Stanford University  - Robotics, a class summarizes these three interpretations adequately: **<mark>Coordinate Representation</mark>** ,**<mark>Coordinate Transformation</mark>**, and **<mark>Point Operator</mark>**. We will explain each of them in the following chapters. 

## 1. Coordinate representation

Coordinate system representation means that the homogenous transformation matrix can be used to represent a coordinate system. Let's look at the two coordinate systems {A} and {B} as shown below. From the previous article on robot positive kinematics - the homogenous transformation matrix, we know that the relationship between the coordinate system {A} and the coordinate system {B} is

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/0.57v0l453c7k0.webp)

<img src="https://latex.codecogs.com/svg.image?_{}^{A}\textrm{T}_B&space;=&space;\begin{bmatrix}_{}^{A}\textrm{R}_B&space;&&space;p_{B_{org}}^{A}&space;\\0&space;&&space;&space;1\\\end{bmatrix}" title="_{}^{A}\textrm{T}_B = \begin{bmatrix}_{}^{A}\textrm{R}_B & p_{B_{org}}^{A} \\0 & 1\\\end{bmatrix}" />

In the article "Robot Positive Kinematics - Understanding Transformation Matrices", we introduced the rotation matrix $ ^AR_B $ (pose relationship between {A} and {B}) representing the projection of the unit vectors of the three axes of the coordinate system {B} in the coordinate system {A} ( i.e. unit vectors in the three axes of coordinates {B} in the coordinate {A}), and in the article "Robot positive kinematics - Homogenous Transformation Matrices", we also saw that $ p_{B_{org}}^{A} $ (position relationship between {A} and {B}) represents the coordinates of the origin of the coordinate system {B} in the coordinate system {A}.

We all know that if we want to determine a coordinate system uniquely, we must understand the origin point and the axis vector. These two elements are all contained in the above homogenous transformation matrix, so we say that the homogenous  transformation matrix can be used to represent a coordinate system, and $ ^AT_B $ is the representation of the coordinate system {B} in the coordinate system {A}.

## 2. Coordinate transformation

Coordinate system transformation means that the homogenous transformation matrix can describe how one coordinate system can be transformed to another system by translations and rotations. As an example, the homogenous transformation matrix between two coordinate systems {A} and {B} can be expressed as

<img src="https://latex.codecogs.com/svg.image?^AT_B&space;=&space;\begin{bmatrix}rot_y(\pi/3)&space;&&space;trans(3,3,2)&space;\\0&space;&&space;1&space;\\\end{bmatrix}&space;" title="^AT_B = \begin{bmatrix}rot_y(\pi/3) & trans(3,3,2) \\0 & 1 \\\end{bmatrix} " />

Here, The $ rot_{y}(\pi /4) $ represents the rotation matrix corresponding to the rotation $ \pi/4 $ around the x-axis, and $ trans(3,3,2) $, represents the translation 3,3,2 in the x, y, and z directions. At this point, we can perform some translations and rotations of the coordinate system {A} to coincide with the coordinate system {B} finally. This procedure corresponds to the following diagram.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/1.moa6ge63wrk.webp)

We divide this operation process into two steps:

- [x] Translating the coordinate system {A} along the black vector until it coincides with the coordinate system {C}, we easily know that this translation is $ trans(3,3,2) $;
- [x] Rotating the coordinate system {C} around its y-axis to coincide with the coordinate system {B}, it is easy to know that the amount of this rotation is $ rot_{y}(\pi /3) $

Thus we say that the homogenous transformation matrix can be used to describe the transformation relations of the coordinate system, and $ ^AT_B $ is the coordinate system {A} can be obtained by translation and rotation of the coordinate system {B}. We can describe such transformation as

<img src="https://latex.codecogs.com/svg.image?\{B\}&space;=&space;\{A\}&space;\cdot&space;^AT_B&space;" title="\{B\} = \{A\} \cdot ^AT_B " />

## Point Operator

The point operator means that the homogenous transformation matrix can be used to translate and rotate any point in the same coordinate. Note that this understanding is quite different from the two previous ones. The first two describe the relationship between two coordinate systems. When discussing the operations of the homogenous transformation matrix on points, our discussion is limited to one coordinate system.

For example, there is a point $ P_{0} $ in the coordinate {A}, and we want to rotate $ \frac{\pi}{4} $ around the x-axis of the coordinate system {A} to get a new point $ P_{1} $. What should we do at this time? It is simple. We just write the following transformation matrix.

<img src="https://latex.codecogs.com/svg.image?R&space;=&space;rot_x(\frac{\pi}{4})&space;=&space;\begin{bmatrix}1&space;&&space;0&space;&&space;0&space;\\0&space;&&space;cos(\frac{\pi}{4})&space;&&space;-sin(\frac{\pi}{4})&space;\\0&space;&&space;sin(\frac{\pi}{4})&space;&&space;cos(\frac{\pi}{4})&space;\\\end{bmatrix}" title="R = rot_x(\frac{\pi}{4}) = \begin{bmatrix}1 & 0 & 0 \\0 & cos(\frac{\pi}{4}) & -sin(\frac{\pi}{4}) \\0 & sin(\frac{\pi}{4}) & cos(\frac{\pi}{4}) \\\end{bmatrix}" />

Then we can use this matrix to multiply the point $ P_{0} $ to get the point $ P_{1} $

If you find this a bit difficult to understand, you can rewind to the first understanding to explain the manipulation of points. At this point, we assume that coordinate system {B} was coincident with the coordinate system {A} at the beginning. The point $ P_{0} $ was fixed in the coordinate system {B}. Then we rotate point $ P_{0} $ around x-axis of the coordinate system{A} to $ \frac{\pi}{4} $, the coordinate system{B} also revolves around the x-axis of the coordinate system {A} to $ \frac{\pi}{4} $. At this point, the transformation matrix between the two coordinate systems is $ rot_x{\frac{\pi}{4}} $. Since the point is fixed in the coordinate system {B}, its coordinates in the coordinate system {B} remain unchanged, so  after the rotation, the coordinates of the point $ P_{0} $ in the coordinate system {A} is

<img src="https://latex.codecogs.com/svg.image?rot_x{\frac{\pi}{4}}&space;\cdot&space;P_{0}" title="rot_x{\frac{\pi}{4}} \cdot P_{0}" />

We can see that this point is the point $ P_{1} $in the coordinate system {A} mentioned earlier.

