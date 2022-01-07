

# Three interpretations of the homogenous transformation matrix

In one of the open Classes at Stanford University  - Robotics, a class summarizes these three interpretations adequately: <mark>**Coordinate Representation**</mark> ,<mark>**Coordinate Transformation**</mark>, and <mark>**Point Operator**</mark>. We will explain each of them in the following chapters. 

## 1. Coordinate system representation

Coordinate system representation means that the homogenous transformation matrix can be used to represent a coordinate system. Let's look at the two coordinate systems {A} and {B} as shown below. From the previous article on robot positive kinematics - the homogenous transformation matrix, we know that the relationship between the coordinate system {A} and the coordinate system {B} is

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/1.64uot34ro940.webp)

<img src="https://latex.codecogs.com/svg.image?_{}^{A}\textrm{T}_B&space;=&space;\begin{bmatrix}_{}^{A}\textrm{R}_B&space;&&space;p_{B_{org}}^{A}&space;\\0&space;&&space;&space;1\\\end{bmatrix}" title="_{}^{A}\textrm{T}_B = \begin{bmatrix}_{}^{A}\textrm{R}_B & p_{B_{org}}^{A} \\0 & 1\\\end{bmatrix}" />

In the article "Robot Positive Kinematics - Understanding Transformation Matrices", we introduced the rotation matrix $_{}^{A}\textrm{T}_B$ (pose relationship between {A} and {B}) representing the projection of the unit vectors of the three axes of the coordinate system {B} in the coordinate system {A} (i.e. unit vectors in the three axes of coordinates {B} in the coordinate {A}), and in the article "Robot positive kinematics - homogenous transformation matrices", we also saw that $p_{B_{org}}^{A}$(position relationship between {A} and {B}) represents the coordinates of the origin of the coordinate system {B} in the coordinate system {A}.

