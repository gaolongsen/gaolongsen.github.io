---
layout:     post
title:      Robot Forward Kinematics - Link Coordinate System and D-H Parameters
subtitle:   
date:       2022-01-03
author:     Longsen Gao
header-img: img/sucai.jpg
catalog: 	true
tags:
    - Robot Forward Kinematics
    - DH Parameter
---

## 1. Link Coordinate System 

From the series of articles we introduced before on coordinate systems, we learned that the homogenous transformation matrix could be used to calculate the coordinates of a spatial point in each coordinate system. At the beginning of the article "**Robot Forward Kinematics - Coordinate Systems and their Transformations**," we posed the problem of how to solve the coordinates of the endpoint P of a multilink robot in the world coordinate system. Here, we can try to solve this problem.

Since relative motion can occur between the various connecting rods of the robot, it is tough to see where the endpoints are in the world coordinate system. So what can we do? We can decompose the problem to make each subproblem less challenging to solve.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/SCARA.2jedyl29kke0.webp)

Suppose we create a coordinate system with the end link fixed. In that case, the coordinates of point P in this coordinate system are easy to give because it is only related to the mechanical structure of the end link, not to the robot's motion. We call this a link coordinate system. A link coordinate system is a whole system that is solidly connected to each robot link. Suppose we create a fixed coordinate system on each connecting rod of the robot, and we find a way to solve the transformation relationship between every two adjacent rods. In that case, it will be easy to map the P-point coordinates to the world coordinate system (the transformation relationship between two adjacent rods is relatively easy to find).

The more critical question is how to solve the transformation relationship between two adjacent coordinate systems. It is not good to establish a linkage system arbitrarily. On the one hand, it will lead to a complex and diverse relationship between the coordinate systems, which is difficult to unify. On the other hand, we may need to make a lot of unnecessary parameter measurements. Therefore, we need to establish guidelines for the link system. We need the guideline to describe each coordinate system with as few parameters as possible, and we also want this guideline to be universally applicable.

This problem was solved by Jacques Denavit and Richard Hartenberg in 1995 when they proposed the famous DH-parameter method for establishing the coordinate system of a connecting rod. Only four parameters are needed to determine its link coordinate system in this guideline.

## 2. DH Parameters

### 2.1 Introduction of DH Parameter

The DH parameter is a kind of method to describe the link coordinate system, as shown in the figure below. It can be thought of as two adjacent links $Link_{i-1}$ and $Link_{i}$ in the robot. Here I still want to explain the meaning of the symbols in the diagram first, especially the subscript meaning, which I often get confused about when I study.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan.5dfzbsxc7ag0.webp)

First, let's define two concepts, drive joints and transmission joints, which are easy to understand. We all know that there are usually servo motors driving at each joint for electrically driven robots. In a tandem robot, the joint of the $Link_i$ near the base drives the motion of $Link_i$. We call this the drive joint of $Link_i$. The joint of $Link_i$ near the end-effector is used to drive the motion of $Link_{i+1}$, so we call this joint the transmission joint of $Link_i$. The coordinate system established by D-H parameters is called the transmission axis coordinate system. Here we need to emphasize that the coordinate system of connecting rod i is built at the drive joint, which is the joint near the end-effector side. In other words,  the coordinate system $O_{i-1}x_{i-1}y_{i-1}z_{i-1}$ (abbreviated as $\{O_{i-1}\}$) is solidly connected with $Link_{i-1}$. The coordinate system $\{O_{i-1}\}$ is connected with $Link_i$.

$Axis_{i-1}$ corresponds to the drive axis of $Link_{i-1}$; Axis_{i} corresponds to the transmission axis of $Link_{i-1}$ and the drive axis of $Link_{i}$; $Axis_{i+1}$ corresponds to the transmission axis of $Link_{i}$.

The two pairs of straight circles 1 and 2 marked with a right slash are parallel straight lines, respectively. The $\theta_{i}$ , $d_{i}$ , $\alpha_{i}$ , and $a_{i}$ in the figure are the DH parameters of $Link_{i}$ that we are going to introduce.

### 2.2 Definition of DH Parameters

I think there are two main reasons why DH parameters are so popular. The first is that DH parameters describe a connecting rod coordinate system with only four parameters; the second is that these four parameters have obvious physical significance.

- $\theta_{i}$ represents the angle of the x-axis between the coordinate system $\{O_{i-1}\}$ and the coordinate system $\{O_{i}\}$, which is the angle of rotation of $Axis_{i}$ (this is also the angle of rotation of the joint i motor).
- $d_{i}$ represents the offset of the coordinate system $\{O_{i}\}$ with respect to the coordinate system $\{O_{i-1}\}$ in the direction of the $z_{i-1}$ axis.
- $\alpha_{i}$ represents the angle between the actuating shaft and the transmission shaft of $Link_{i}$.
- $a_{i}$ represents the length of $Link_{i}$ in the mathematical sense

From the above description, we can see that 1 and 2 describe the relationship between $Link_{i-1}$ and $Link_{i}$, and 3 and 4 illustrate the intrinsic properties of $Link_{i}$ (because they are only related to $Link_{i}$). So to be clear about DH parameters, it is better to look at these two sets of parameters with different meanings separately..

### 2.2.1 Twist angle and length of connecting rod

We start with the definition of $\alpha_{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha_{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

We start with the definition of $\alpha_{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha_{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan2.7h3sh8jojik0.webp)

No matter how complex this link is, we can give a unified description of it: the two joint axes ($Axis_{i}$ and $Axis_{i+1}$) and their common vertical line (circle 1) are the most straightforward abstractions of a link. Here, non-coplanar straight lines have only one common vertical line.

We define the angle between the two non-coplanar straight lines $Axis_{i}$ and $Axis_{i+1}$ as the joint twist angle $\alpha_{i}$ of the connecting rod. The two lines corresponding to the double right slash in the figure are parallel. $\alpha$ is the second parameter in the DH parameter.

### 2.2.2 Connecting rod angle and connecting rod offset

Next, let's look at the definition of the connecting rod angle $\theta_{i}$ and the connecting rod offset $d_{i}$. These two parameters describe a positional relationship. Again, they describe a position relationship between two adjacent connecting rods and no longer the rod's inherent properties. In this case $\theta_{i}$ and $d_{i}$ describe the position relationship of $Link_{i}$ with respect to $Link_{i-1}$.

Returning to Figure 1, $\{O_{i-1}\}$ and $\{O_{i}\}$ are the coordinate systems solidly connected to $Link_{i-1}$ and $Link_{i}$, respectively. By our definition, the x-axis of $\{O_{i-1}\}$ is built on the common vertical line of $Axis_{i-1}$ and $Axis_{i}$, and the x-axis of $\{O_{i}\}$ is built on the common vertical line of $Axis_{i}$ and $Axis_{i+1}$. It shows that the x-axis of $\{O_{i-1}\}$ and the x-axis of $\{O_{i}\}$ are both perpendicular to $Axis_{i}$, which means that $Axis_{i}$ is the common vertical line of the non-coplanar lines $x_{i-1}$ and $x_{i}$.

The two lines corresponding to the single right slash in Figure 1 are parallel, then $\theta_{i}$ corresponds to the angle between the lines $x_{i-1}$ and $x_{i}$. Therefore, we define the angle between the x-axis of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the connecting rod turning angle $\theta_{i}$.

We find that the x-axis of $\{O_{i-1}\}$ is parallel to the x-axis of $\{O_{i}\}$ after $\{O_{i-1}\} rotate $\theta_{i}$ degrees along $Axis_{i}$ (i.e. the z-axis of $\{O_{i-1}\}$)! We define the length of the common vertical line between the x-axes of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the rod offset $d_{i}$.

We find that when we rotate $\{O_{i-1}\}$ along $Axis_{i}$ by $\theta_{i}$ degrees, then translates $d_{i}$ along the z-axis of the new coordinate system. We will find that the new coordinate system and the x-axis of $\{O_{i}\}$ have coincided exactly.

Further, rotating the new coordinate system along its x-axis by $\alpha_{i}$ degrees, we find that the new coordinate system and $\{O_{i}\}$ not only coincide on the x-axis, but the z-axes of those are parallel with each other! So what if we then translate $\A_{i}$ along the x-axis? The two coordinate systems coincide precisely in this case.

The process described above can be expressed as the equations in the following

<img src="https://latex.codecogs.com/svg.image?^{i-1}T_i&space;=&space;rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)" title="^{i-1}T_i = rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)" />

This transformation matrix maps the points in \{O_{i}\} to \{O_{i-1}\}. Note that successive translations and rotations along the same axis can be exchanged. It's easy to see if you think about it from a geometric point of view, so translations and rotations along z can be exchanged, and translations and rotations along the x-axis can also be exchanged.

## 3. Real problem analysis

Here we can finally solve the problem mentioned earlier about the coordinates of the robot endpoint in the base coordinate system. The method is straightforward, that is, to establish a coordinate system on each rod and then use the transformation relationship mentioned above to find the transformation relationship between adjacent rods so that the problem can be solved. The following figure shows the coordinate system established on each rod of the SCARA robot, with some auxiliary lines added for easy observation.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/SCARA.67tf9moq0no0.webp)

Let's list the parameters of the robot in the following table. (Please keep in mind that the DH parameters $\theta$ represent the angle between the two x-axes, $d$ represents the length of the common vertical line of the two x-axes, $\alpha$ represents the angle between the two z-axes, and $a$ represents the length of the common vertical line of the two z-axes)

| Rod number |  $\theta$  |  $d$  | $\alpha$ |  $a$  |
| :--------: | :--------: | :---: | :------: | :---: |
|     1      | $\theta_1$ | $d_1$ |    0     | $l_1$ |
|     2      | $\theta_2$ |   0   |    0     | $l_2$ |
|     3      | $\theta_3$ | $d_3$ |    0     |   0   |
|     4      | $\theta_4$ |   0   |    0     |   0   |

Here the DH parameter table is finished. The third axis of the SCARA robot is a translation joint, and the variables in the DH parameter table are $\theta_{1}$, $\theta_{2}$, $d_{3}$, $\theta_{4}$, and the rest of the parameters are fixed values. Remember the transformation relation we introduced in 2.2.2? This transformation can describe the relationship between every two adjacent connecting rods. Thus we can find.

<img src="https://latex.codecogs.com/svg.image?\begin{aligned}^0T_1&space;&=&space;rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)\\^1T_2&space;&=&space;rot_z(\theta_2)trans_x(l_2)\\^2T_3&space;&=&space;trans_z(d_3)\\^3T_4&space;&=&space;rot_z(\theta_4)\end{aligned}" title="\begin{aligned}^0T_1 &= rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)\\^1T_2 &= rot_z(\theta_2)trans_x(l_2)\\^2T_3 &= trans_z(d_3)\\^3T_4 &= rot_z(\theta_4)\end{aligned}" />

Is point P the origin of the coordinate system {4}? How is it represented in the base coordinate system? It is simple to iterate all the transformations.

<img src="https://latex.codecogs.com/svg.image?P^0&space;=&space;^0T_1&space;\cdot&space;^1T_2&space;\cdot&space;^2T_3&space;\cdot&space;^3T_4&space;\cdot&space;\begin{bmatrix}0&space;\\0&space;\\0&space;\\1\end{bmatrix}" title="P^0 = ^0T_1 \cdot ^1T_2 \cdot ^2T_3 \cdot ^3T_4 \cdot \begin{bmatrix}0 \\0 \\0 \\1\end{bmatrix}" />

Therefore, when we measure the values of each variable in the DH parameters and the known structural parameters of the robot, we can solve for the coordinates of the endpoint P in the base coordinate system by simply substituting them into the above equation.



