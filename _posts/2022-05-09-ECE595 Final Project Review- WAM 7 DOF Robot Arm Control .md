---
layout:     post
title:      Final Project Review- WAM 7 DOF Robot Arm Control
subtitle:   
date:       2022-01-19
author:     Longsen Gao
header-img: img/background2.jpg
catalog: 	true
tags:
    - Control Theory
    - Robotics
    - Python
---

## 1. Introduction for WAM Arm

### 1.1 Background

 The WAM Arm is a 7-degree-of-freedom (7-DOF)  manipulator with human- like kinematics. With its aluminum  frame and advanced cable-drive systems, including a patented  cabled differential, the WAM is lightweight with no backlash,  extremely low friction, and stiff transmissions. All of these characteristics contribute to its highbandwidth performance.  The WAM Arm is the ideal platform for implementing Whole  Arm Manipulation (WAM), advanced force control techniques,  and high precision trajectory control. WAM is shown in figure 1.

![](https://robots.ieee.org/robots/wam/Photos/SD/wam-photo1-full.jpg)

​                                                                       Figure 1 : WAM Arm

The WAM Arm is a highly dexterous back drivable  manipulator. It is the only commercially available robotic arm  with direct-drive capability supported by Transparent Dynamic  between the motors and joints, so its joint-torque control is  unmatched and guaranteed stable. 

### 2.2 Information of  Joints and Dimensions

WAM Arm robot has 7 DoFs. It has 7 links and 7 joints. The joints and  dimensions are shown in Figure 2. 

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/1.244yijk23y0w.webp)

​                                               Figure 2. D-H coordinates and dimensions 

| Joint | Min Angle Limit(Rad) | Max. Angle limit(Rad) |
| ----- | -------------------- | --------------------- |
| 1     | -2.6                 | 2.6                   |
| 2     | -2.0                 | 2.0                   |
| 3     | -2.8                 | 2.8                   |
| 4     | -0.9                 | 3.1                   |
| 5     | -4.8                 | 1.3                   |
| 6     | -1.6                 | 1.6                   |
| 7     | -2.2                 | 2.2                   |



## 3. Basic Background for Robotics Kinematics

### 3.1 DH Parameters

### 3.1.1 Introduction of DH Parameter

The DH parameter is a kind of method to describe the link coordinate system, as shown in the figure below. It can be thought of as two adjacent links $Link_{i-1}$ and $Link_{i}$ in the robot. Here I still want to explain the meaning of the symbols in the diagram first, especially the subscript meaning, which I often get confused about when I study.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan.5dfzbsxc7ag0.webp)

First, let's define two concepts, drive joints and transmission joints, which are easy to understand. We all know that there are usually servo motors driving at each joint for electrically driven robots. In a tandem robot, the joint of the $Link_i$ near the base drives the motion of $Link_i$. We call this the drive joint of $Link_i$. The joint of $Link_i$ near the end-effector is used to drive the motion of $Link_{i+1}$, so we call this joint the transmission joint of $Link_i$. The coordinate system established by D-H parameters is called the transmission axis coordinate system. Here we need to emphasize that the coordinate system of connecting rod i is built at the drive joint, which is the joint near the end-effector side. In other words,  the coordinate system $O_{i-1}x_{i-1}y_{i-1}z_{i-1}$ (abbreviated as $\{O_{i-1}\}$) is solidly connected with $Link_{i-1}$. The coordinate system $\{O_{i-1}\}$ is connected with $Link_i$.

$Axis_{i-1}$ corresponds to the drive axis of $Link_{i-1}$; Axis_{i} corresponds to the transmission axis of $Link_{i-1}$ and the drive axis of $Link_{i}$; $Axis_{i+1}$ corresponds to the transmission axis of $Link_{i}$.

The two pairs of straight circles 1 and 2 marked with a right slash are parallel straight lines, respectively. The $\theta_{i}$ , $d_{i}$ , $\alpha_{i}$ , and $a_{i}$ in the figure are the DH parameters of $Link_{i}$ that we are going to introduce.

### 3.1.2 Definition of DH Parameters

I think there are two main reasons why DH parameters are so popular. The first is that DH parameters describe a connecting rod coordinate system with only four parameters; the second is that these four parameters have obvious physical significance.

- $\theta_{i}$ represents the angle of the x-axis between the coordinate system $\{O_{i-1}\}$ and the coordinate system $\{O_{i}\}$, which is the angle of rotation of $Axis_{i}$ (this is also the angle of rotation of the joint i motor).
- $d_{i}$ represents the offset of the coordinate system $\{O_{i}\}$ with respect to the coordinate system $\{O_{i-1}\}$ in the direction of the $z_{i-1}$ axis.
- $\alpha_{i}$ represents the angle between the actuating shaft and the transmission shaft of $Link_{i}$.
- $a_{i}$ represents the length of $Link_{i}$ in the mathematical sense

From the above description, we can see that 1 and 2 describe the relationship between $Link_{i-1}$ and $Link_{i}$, and 3 and 4 illustrate the intrinsic properties of $Link_{i}$ (because they are only related to $Link_{i}$). So to be clear about DH parameters, it is better to look at these two sets of parameters with different meanings separately..

### 3.1.3 Twist angle and length of connecting rod

We start with the definition of $\alpha_{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha_{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

We start with the definition of $\alpha_{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha_{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan2.7h3sh8jojik0.webp)

No matter how complex this link is, we can give a unified description of it: the two joint axes ($Axis_{i}$ and $Axis_{i+1}$) and their common vertical line (circle 1) are the most straightforward abstractions of a link. Here, non-coplanar straight lines have only one common vertical line.

We define the angle between the two non-coplanar straight lines $Axis_{i}$ and $Axis_{i+1}$ as the joint twist angle $\alpha_{i}$ of the connecting rod. The two lines corresponding to the double right slash in the figure are parallel. $\alpha$ is the second parameter in the DH parameter.

### 3.1.4 Connecting rod angle and connecting rod offset

Next, let's look at the definition of the connecting rod angle $\theta_{i}$ and the connecting rod offset $d_{i}$. These two parameters describe a positional relationship. Again, they describe a position relationship between two adjacent connecting rods and no longer the rod's inherent properties. In this case $\theta_{i}$ and $d_{i}$ describe the position relationship of $Link_{i}$ with respect to $Link_{i-1}$.

Returning to Figure 1, $\{O_{i-1}\}$ and $\{O_{i}\}$ are the coordinate systems solidly connected to $Link_{i-1}$ and $Link_{i}$, respectively. By our definition, the x-axis of $\{O_{i-1}\}$ is built on the common vertical line of $Axis_{i-1}$ and $Axis_{i}$, and the x-axis of $\{O_{i}\}$ is built on the common vertical line of $Axis_{i}$ and $Axis_{i+1}$. It shows that the x-axis of $\{O_{i-1}\}$ and the x-axis of $\{O_{i}\}$ are both perpendicular to $Axis_{i}$, which means that $Axis_{i}$ is the common vertical line of the non-coplanar lines $x_{i-1}$ and $x_{i}$.

The two lines corresponding to the single right slash in Figure 1 are parallel, then $\theta_{i}$ corresponds to the angle between the lines $x_{i-1}$ and $x_{i}$. Therefore, we define the angle between the x-axis of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the connecting rod turning angle $\theta_{i}$.

We find that the x-axis of $\{O_{i-1}\}$ is parallel to the x-axis of $\{O_{i}\}$ after $\{O_{i-1}\}$ rotate $\theta_{i}$ degrees along $Axis_{i}$ (i.e. the z-axis of $\{O_{i-1}\}$)! We define the length of the common vertical line between the x-axes of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the rod offset $d_{i}$.

We find that when we rotate $\{O_{i-1}\}$ along $Axis_{i}$ by $\theta_{i}$ degrees, then translates $d_{i}$ along the z-axis of the new coordinate system. We will find that the new coordinate system and the x-axis of $\{O_{i}\}$ have coincided exactly.

Further, rotating the new coordinate system along its x-axis by $\alpha_{i}$ degrees, we find that the new coordinate system and $\{O_{i}\}$ not only coincide on the x-axis, but the z-axes of those are parallel with each other! So what if we then translate $a_{i}$ along the x-axis? The two coordinate systems coincide precisely in this case.

The process described above can be expressed as the equations in the following

<img src="https://latex.codecogs.com/svg.image?^{i-1}T_i&space;=&space;rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)" title="^{i-1}T_i = rot_z(\theta_i)trans_z(d_i)rot_x(\alpha_i)trans_x(a_i)" />

This transformation matrix maps the points in $\{O_{i}\}$ to $\{O_{i-1}\}$. Note that successive translations and rotations along the same axis can be exchanged. It's easy to see if you think about it from a geometric point of view, so translations and rotations along z can be exchanged, and translations and rotations along the x-axis can also be exchanged.

The D-H parameters themselves are not complicated, but initially, I felt very confused when I applied them to the robot to establish the coordinate system. There are many reasons for the feeling of confusion, summarized as follows:

- [x] It is not easy to distinguish each linkage on the robot, and the numbering of the links can be easily confused.
- [x] It is a little hard to determine whether a distance is the link offset $ d $ or the length of the link $ a $.
- [x] It's difficult to determine the x-axis direction of the coordinate system.
- [x] After establishing the coordinate system, we found that we couldn't make each coordinate system overlap.

So are there any tips for establishing a DH coordinate system? Let's introduce how to quickly set the D-H coordinate system of a robot.

## 3.2 Real problem Analysis on DH Parameters for WAM Robot Arm

#### 3.2.1 Figuring out joints and links

The first step is to figure out the locations of joint 1 , link 1 , the origin of the coordinate system 1 that is solidly connected to link 1, and so on. Again, I want to emphasize that the DH coordinate system is built on the link's drive axis away from the base. So for a tandem robot, the joints, links, and the coordinate system should be arranged in order of distance from the base: first is joint 1, followed by link 1 mounted on joint 1, followed by coordinate system 1 attached to link 1, followed by joint 2. Please note that the axis of the z-axis of the coordinate system of connecting link1 is the drive axis of link 2.

Let's take the WAM robot arm to establish the DH coordinate system as an example. To make it easy to see each link, I have painted each link with a different color, as shown in the figure below.

<iframe src="https://giphy.com/embed/wanSKXy2Hvf44sLjIP" width="700" height="379" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>

Imagine whether you can see all the links at once without coloring them? Would you know where the coordinate system for link 1 should be established?

### 3.2.2 Plot z-axis

In the second step， we need to determine the z-axis of each link. This step is pretty easy because the z-axis should be in the same direction as the joint axes in a rule. So the only thing you need to figure out is which links these z-axes should be fixed. Since the DH parameters should be built on the drive link, those z-axes must be built on the side of the links away from the base.

We paint the coordinate system fixed to the link with the same color.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_z.6lvj1omtv040.webp)

### 3.2.3 Determine the x-axis

In the third step, we need to determine the x-axis as the most challenging part of the whole process. Here you need to determine two things. First, you need to select the direction of the x-axis, and second, you need to figure out where the origin of the coordinate system is. That is, you need to determine the starting point of the x-axis.

### 3.2.4  x-axis direction

Let's address the first point. The X-axis of the DH coordinate system is the common vertical line between the drive and transmission draft of the connecting rod. So the direction of the x-axis is relatively easy to obtain. We know that the cross product (outer product) of two non-parallel vectors is the common normal of the two vectors. So we define.

<img src="https://latex.codecogs.com/svg.image?x_i&space;=&space;z_{i&space;-&space;1}&space;\times&space;z_i" title="x_i = z_{i - 1} \times z_i" />

In this way, you can determine the x-axis of each link coordinate system. Eventually, you can make all x-axes point uniformly at their transmission axes. When the drive and transmission axes are parallel, you can draw a vector that is perpendicular to and intersects both axes and that points to the transmission axis.

### 3.2.5  The start point of the x-axis (origin of the coordinate system)

Next, we need to figure out the second issue. How do we determine the origin for the x-axis? In advance, this problem does not exist when the drive axis and transmission axis are non-coplanar
because there is only one common vertical line for the non-coplanar lines. The origin has been determined with the x-axis (the intersection of the x-axis and z-axis).

In addition to non-coplanar straight lines, there are two other relationships between the drive and transmission axis, one is parallel and the other is intersecting. There are countless common perpendiculars between the drive and transmission axes in these two relationships. How to determine the origin of the coordinate system at this time?

According to D-H's rules, the common perpendicular line between the two z-axes represents the abstract link length. The length of the common vertical line between the two x-axes represents the offset of the adjacent links. It would help if you considered the physical meaning of these parameters when determining the origin of the coordinate system. Now we know z-axes and the directions of x-axes, as results, the lengths of the link($ \alpha $ in the DH parameters) can also be determined. Then we must make sure the coordinate system of link $i-1$ rotates around the $z_{i-1}$ axis and translates along the  $z_{i-1}$ axis to make $x_{i-1}$ and  $x_i$ coincide before we choose the origin of the x-axis. When you find that $x_{i-1}$ and $x_i$ cannot coincide by such transformation, there is a problem with choosing the origin of the link i. 

The above elaboration is still too obscure, let's use the WAM robot arm as an example to illustrate the process of determining the origin of the coordinate system.

Before we do that, let's determine the base coordinate system and the link1 coordinate system, usually the x-axis of the base points directly in front of the robot. Therefore, we can quickly determine the base frame. The drive and transmission axes of link 1 are non-coplanar straight lines, so the x-axis of the link1 coordinate system can also be easily determined from the cross multiplication equation mentioned earlier. Thus base frame and link1 can be specified as shown in the figure below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_z_zb_x0.5krgyf6w7q40.webp)

Next, we start to determine the x-axis of llink2. We find that z0 and z1 are also non-coplanar lines, so by making a common vertical line of these two axes in the direction directly in front of the robot arm, we can quickly determine x1 as shown below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x1.1hgea2v7usgw.webp)

Similarly, we can find the axis x2,x3, x4, x5 and x6 in the same way as shown below

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x6.44ekon8pbh40.webp)

For link 6, we find countless common vertical lines of z6 and z7. How can we determine the x-axis for this link? It is straightforward because the coordinate system of link5 has been determined. We need to make a paneled line with axis z7 through the origin of the link5 coordinate system. Finally, we translate this axis to the origin of the coordinate system of link6 to get axis x7

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_x7.36pzni9cvdo0.webp)

The final DH coordinate system of the WAM robot is shown below.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/111_total.7bqeoh2okps0.webp)

The DH parameter table of the WAM robot arm is shown below.

|  i   |    $a_i$    |  $d_i$  | $\alpha_i$ | $\theta_i$ |
| :--: | :---------: | :-----: | :--------: | :--------: |
|  1   |      0      |    0    |  $-\pi/2$  | $\theta_1$ |
|  2   |      0      |    0    |  $\pi/2$   | $\theta_2$ |
|  3   | a3 = 0.045  | d3=0.55 |  $-\pi/2$  | $\theta_3$ |
|  4   | a4 = -0.045 |    0    |  $\pi/2$   | $\theta_4$ |
|  5   |      0      | d5=0.3  |  $-\pi/2$  | $\theta_5$ |
|  6   |      0      |    0    |  $\pi/2$   | $\theta_6$ |
|  7   |      0      | d6=0.06 |     0      | $\theta_7$ |



### 3.3 Workspace Plots for WAM Robot Arm

By using the coordinate transformation matrix and coding in MATLAB , the workspace of 7 DoF is plotted.  Different views of the workspace is plotted in below figures. 

Isometric view of WAM’s Workspace as shown below.

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/2.vomfsbpbi1s.webp)

Top view of WAM’s Workspace as shown below.

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/3.rk8khwd6syo.webp)

 Side view of WAM's Workspace (Y-Z) as shown below.

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/4.31qe46kkgfa0.webp)

Side view of WAM's Workspace (X-Z) as shown below.

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/5.61ktstx45900.webp)

### 3.4 Forward Kinematics of WAM Arm

The robot that is researched is composed of seven revolute joints with three consecutive parallel axes. To realize kinematic control and describe the kinematic relationship between the pose of the robot’s end-effector and joint angle, let's review the mechanical structure and joint coordinate system of this manipulator again. 

![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/1.244yijk23y0w.webp)



|  i   |    $a_i$    |  $d_i$  | $\alpha_i$ | $\theta_i$ |
| :--: | :---------: | :-----: | :--------: | :--------: |
|  1   |      0      |    0    |  $-\pi/2$  | $\theta_1$ |
|  2   |      0      |    0    |  $\pi/2$   | $\theta_2$ |
|  3   | a3 = 0.045  | d3=0.55 |  $-\pi/2$  | $\theta_3$ |
|  4   | a4 = -0.045 |    0    |  $\pi/2$   | $\theta_4$ |
|  5   |      0      | d5=0.3  |  $-\pi/2$  | $\theta_5$ |
|  6   |      0      |    0    |  $\pi/2$   | $\theta_6$ |
|  7   |      0      | d6=0.06 |     0      | $\theta_7$ |

According to the D–H rules and parameters of this manipulator listed aboved, the coordinate transform matrix of adjacent joints can be obtained by using a homogeneous transformation matrix.

<img src="https://latex.codecogs.com/svg.image?\begin{equation}{&space;}_{i}^{i-1}&space;\boldsymbol{T}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}{ }_{i}^{i-1} \boldsymbol{T}\end{equation}" />

<img src="https://latex.codecogs.com/svg.image?\begin{equation}{&space;}_{i}^{i-1}&space;\boldsymbol{T}=\left[\begin{array}{cccc}c&space;\theta_{i}&space;&&space;-s&space;\theta_{i}&space;&&space;0&space;&&space;a_{i-1}&space;\\s&space;\theta_{i}&space;c&space;\alpha_{i-1}&space;&&space;c&space;\theta_{i}&space;c&space;\alpha_{i-1}&space;&&space;-s&space;\alpha_{i-1}&space;&&space;-d_{i}&space;s&space;\alpha_{i-1}&space;\\s&space;\theta_{i}&space;s&space;\alpha_{i-1}&space;&&space;c&space;\theta_{i}&space;s&space;\alpha_{i-1}&space;&&space;c&space;\alpha_{i-1}&space;&&space;d_{i}&space;c&space;\alpha_{i-1}&space;\\0&space;&&space;0&space;&&space;0&space;&&space;1\end{array}\right]\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}{ }_{i}^{i-1} \boldsymbol{T}=\left[\begin{array}{cccc}c \theta_{i} & -s \theta_{i} & 0 & a_{i-1} \\s \theta_{i} c \alpha_{i-1} & c \theta_{i} c \alpha_{i-1} & -s \alpha_{i-1} & -d_{i} s \alpha_{i-1} \\s \theta_{i} s \alpha_{i-1} & c \theta_{i} s \alpha_{i-1} & c \alpha_{i-1} & d_{i} c \alpha_{i-1} \\0 & 0 & 0 & 1\end{array}\right]\end{equation}" />

where

<img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}c&space;\theta_{i}&space;&=\cos&space;\left(\theta_{i}\right)&space;\\s&space;\theta_{i}&space;&=\sin&space;\left(\theta_{i}\right)&space;\\c&space;\alpha_{i-1}&space;&=\cos&space;\left(\alpha_{i-1}\right)&space;\\s&space;\alpha_{i-1}&space;&=\sin&space;\left(\alpha_{i-1}\right)\end{aligned}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}c \theta_{i} &=\cos \left(\theta_{i}\right) \\s \theta_{i} &=\sin \left(\theta_{i}\right) \\c \alpha_{i-1} &=\cos \left(\alpha_{i-1}\right) \\s \alpha_{i-1} &=\sin \left(\alpha_{i-1}\right)\end{aligned}\end{equation}" />

When the values of all joint angles are known, the homogeneous transformation matrix of the end-effector relative to the base can be obtained by multiplying seven homogeneous transformation matrices.

<img src="https://latex.codecogs.com/svg.image?\begin{equation}{&space;}_{7}^{0}&space;\boldsymbol{T}={&space;}_{1}^{0}&space;\boldsymbol{T}_{2}^{1}&space;\boldsymbol{T}_{3}^{2}&space;\boldsymbol{T}_{4}^{3}&space;\boldsymbol{T}_{5}^{4}&space;\boldsymbol{T}_{6}^{5}&space;\boldsymbol{T}_{7}^{6}&space;\boldsymbol{T}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}{ }_{7}^{0} \boldsymbol{T}={ }_{1}^{0} \boldsymbol{T}_{2}^{1} \boldsymbol{T}_{3}^{2} \boldsymbol{T}_{4}^{3} \boldsymbol{T}_{5}^{4} \boldsymbol{T}_{6}^{5} \boldsymbol{T}_{7}^{6} \boldsymbol{T}\end{equation}" />

According to Equation (2) the forward kinematic solution can be obtained, which indicates the position and orientation of the end-effector.

### 3.4 Inverse Kinematics of WAM Arm

According to the configuration characteristics of this manipulator, the last three joints of the manipulator are equivalent to a spherical joint, which can reach any orientation. Therefore, for the inverse kinematics, the separation of position and orientation can be achieved. In this way, the first four joints of the manipulator determine the position of the end-effector; the last three joints determine the orientation of the end-effector.

Assuming the position and orientation of the manipulator are known as

<img src="https://latex.codecogs.com/svg.image?\begin{equation}{&space;}_{7}^{0}&space;\boldsymbol{T}=\left[\begin{array}{cc}{&space;}_{7}^{0}&space;\boldsymbol{R}&space;&&space;{&space;}_{7}^{0}&space;\boldsymbol{P}&space;\\0&space;&&space;1\end{array}\right]=\left[\begin{array}{cccc}n_{x}&space;&&space;o_{x}&space;&&space;a_{x}&space;&&space;p_{x}&space;\\n_{y}&space;&&space;o_{y}&space;&&space;a_{y}&space;&&space;p_{y}&space;\\n_{z}&space;&&space;o_{z}&space;&&space;a_{z}&space;&&space;p_{z}&space;\\0&space;&&space;0&space;&&space;0&space;&&space;1\end{array}\right]\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}{ }_{7}^{0} \boldsymbol{T}=\left[\begin{array}{cc}{ }_{7}^{0} \boldsymbol{R} & { }_{7}^{0} \boldsymbol{P} \\0 & 1\end{array}\right]=\left[\begin{array}{cccc}n_{x} & o_{x} & a_{x} & p_{x} \\n_{y} & o_{y} & a_{y} & p_{y} \\n_{z} & o_{z} & a_{z} & p_{z} \\0 & 0 & 0 & 1\end{array}\right]\end{equation}" />

The inverse kinematics can be solved by the following steps:

1. **$\theta_{1}$**:

   Since the axes of the joints 2, 3, 4 are parallel to each other, the position of the self-motion plane *P* is only determined by joint 1. Therefore, the expression of $\theta_{1}$ is

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{1}=\operatorname{atan}&space;2\left(\boldsymbol{n}_{0}&space;\times&space;\boldsymbol{n}_{1}&space;\cdot&space;\boldsymbol{z}_{1},&space;\boldsymbol{n}_{0}&space;\cdot&space;\boldsymbol{n}_{1}\right)&plus;\frac{\left(1-G&space;K_{1}\right)&space;\pi}{2}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{1}=\operatorname{atan} 2\left(\boldsymbol{n}_{0} \times \boldsymbol{n}_{1} \cdot \boldsymbol{z}_{1}, \boldsymbol{n}_{0} \cdot \boldsymbol{n}_{1}\right)+\frac{\left(1-G K_{1}\right) \pi}{2}\end{equation}" />

   where $GK_1= ±1$ corresponding to the two solutions of $\theta_{1}$, $n_0$ and $z_1$ is the axis direction of the joint 1 in the base coordinate system, $n_0$ and $n_1$ are the normal vectors of the initial principal plane $P$ and the corresponding principal plane $P$ of the current point *W*.

   

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{gathered}\boldsymbol{n}_{0}=\left[\begin{array}{lll}0&space;&&space;1&space;&&space;0\end{array}\right]^{\mathrm{T}}&space;\\\boldsymbol{n}_{1}=\boldsymbol{O}&space;\boldsymbol{S}&space;\times&space;\boldsymbol{S}&space;\boldsymbol{W}=\left[\begin{array}{lll}-d_{1}&space;p_{y}&space;&&space;d_{1}&space;p_{x}&space;&&space;0\end{array}\right]^{\mathrm{T}}\end{gathered}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{gathered}\boldsymbol{n}_{0}=\left[\begin{array}{lll}0 & 1 & 0\end{array}\right]^{\mathrm{T}} \\\boldsymbol{n}_{1}=\boldsymbol{O} \boldsymbol{S} \times \boldsymbol{S} \boldsymbol{W}=\left[\begin{array}{lll}-d_{1} p_{y} & d_{1} p_{x} & 0\end{array}\right]^{\mathrm{T}}\end{gathered}\end{equation}" />

   

   where

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}&\boldsymbol{O}&space;\boldsymbol{S}=\left[\begin{array}{lll}0&space;&&space;0&space;&&space;d_{1}\end{array}\right]^{\mathrm{T}}&space;\\&\boldsymbol{S&space;W}=\boldsymbol{O&space;W}-\boldsymbol{O}&space;\boldsymbol{S}=\left[\begin{array}{lll}p_{x}&space;&&space;p_{y}&space;\quad&space;p_{z}-d_{1}\end{array}\right]^{\mathrm{T}}\end{aligned}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}&\boldsymbol{O} \boldsymbol{S}=\left[\begin{array}{lll}0 & 0 & d_{1}\end{array}\right]^{\mathrm{T}} \\&\boldsymbol{S W}=\boldsymbol{O W}-\boldsymbol{O} \boldsymbol{S}=\left[\begin{array}{lll}p_{x} & p_{y} \quad p_{z}-d_{1}\end{array}\right]^{\mathrm{T}}\end{aligned}\end{equation}" />

   

   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/6.7k4oxb0cxbk0.webp)



2. **$\theta_{2}$**

   $\theta_{2}$ can represent the angle of rotation from ***x\***1 to ***x\***2 around $z_2$, and $x_2$ is collinear with the link *SA*. If the redundancy angle *φ* is known, $\theta_{2}$ can be expressed as

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{2}=G&space;K_{1}&space;\cdot&space;\varphi&plus;\varphi_{S&space;M}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{2}=G K_{1} \cdot \varphi+\varphi_{S M}\end{equation}" />

   where $\phi$ is the redundant angle,

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\varphi&space;S&space;M\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\varphi S M\end{equation}" />

   can represent the angle of rotation from $x_1$ to *SW* around $z_2$.

   

   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/7.2bsk541s0vy8.webp)

   

3. **$\theta_{3}$**

   The position of point *A* can be solved when the angles $\theta_{1}$ and $\theta_{2}$ are known. At this time, *AW*, *AE*, and *EW* form a fixed triangle with a fixed edge length in the figure below . In this way, the position of point *E* can be obtained.

   

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{gathered}\psi=G&space;K_{2}&space;\cdot&space;\arccos&space;\left(\frac{d_{3}^{2}&plus;|\boldsymbol{A}&space;\boldsymbol{W}|^{2}-d_{4}^{2}}{2&space;d_{3}|\boldsymbol{A}&space;\boldsymbol{W}|}\right)&space;\\\boldsymbol{A}&space;\boldsymbol{E}=d_{3}&space;\cdot&space;\operatorname{Rot}\left(\boldsymbol{z}_{2},&space;\psi\right)&space;\frac{\boldsymbol{A}&space;\boldsymbol{W}}{|\boldsymbol{A}&space;\boldsymbol{W}|}\end{gathered}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{gathered}\psi=G K_{2} \cdot \arccos \left(\frac{d_{3}^{2}+|\boldsymbol{A} \boldsymbol{W}|^{2}-d_{4}^{2}}{2 d_{3}|\boldsymbol{A} \boldsymbol{W}|}\right) \\\boldsymbol{A} \boldsymbol{E}=d_{3} \cdot \operatorname{Rot}\left(\boldsymbol{z}_{2}, \psi\right) \frac{\boldsymbol{A} \boldsymbol{W}}{|\boldsymbol{A} \boldsymbol{W}|}\end{gathered}\end{equation}" />

   

   where $GK_2= ±1$ corresponds to the two possible positions of the point *E*, corresponding to point *E* above and point *E*’ below, respectively. |***AW\***| represents the distance from point *A* to *W*.

   

   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/8.4m03bbu0fvc0.webp)

   

   $\theta_{3}$ is the angle of rotation from *SA* to *AE* around ***z\***3, so *θ*3 can be expressed as follows:

4. **$\theta_{4}$**

   According to the D–H method, $\theta_{4}$ is the angle of rotation from $x_3$ to $x_4$ around $z_4$.

   

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{4}=\operatorname{atan}&space;2\left(\boldsymbol{x}_{3}&space;\times&space;\boldsymbol{x}_{4}&space;\cdot&space;\boldsymbol{z}_{4},&space;\boldsymbol{x}_{3}&space;\cdot&space;\boldsymbol{x}_{4}\right)\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\theta_{4}=\operatorname{atan} 2\left(\boldsymbol{x}_{3} \times \boldsymbol{x}_{4} \cdot \boldsymbol{z}_{4}, \boldsymbol{x}_{3} \cdot \boldsymbol{x}_{4}\right)\end{equation}" />

   where $z_2$ is parallel to $z_4$. $X_3$ can be obtained by coordinate transformation according to $\theta_{1}$, $\theta_{2}$, and $\theta_{3}$. Because *EW* and $z_5$ are collinear with each other, $x_4$ can be expressed as

   

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\boldsymbol{x}_{4}=\boldsymbol{z}_{4}&space;\times&space;\boldsymbol{z}_{5}=\boldsymbol{z}_{3}&space;\times&space;\frac{\boldsymbol{E}&space;W}{|\underline{\boldsymbol{E}&space;W}|}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\boldsymbol{x}_{4}=\boldsymbol{z}_{4} \times \boldsymbol{z}_{5}=\boldsymbol{z}_{3} \times \frac{\boldsymbol{E} W}{|\underline{\boldsymbol{E} W}|}\end{equation}" />

5. **$\theta_{5}$, $\theta_{6}$, and $\theta_{7}$**

   According to the above analysis, the values of the first four joints have been obtained, and the transformation matrix from the initial orientation to the target orientation can be described as

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}{&space;}_{7}^{4}&space;\boldsymbol{R}={&space;}_{4}^{0}&space;\boldsymbol{R}^{-1}&space;\cdot{&space;}_{7}^{0}&space;\boldsymbol{R}=\left[\begin{array}{ccc}n_{x}^{\prime}&space;&&space;o_{x}^{\prime}&space;&&space;a_{x}^{\prime}&space;\\n_{y}^{\prime}&space;&&space;o_{y}^{\prime}&space;&&space;a_{y}^{\prime}&space;\\n_{z}^{\prime}&space;&&space;o_{z}^{\prime}&space;&&space;a_{z}^{\prime}\end{array}\right]\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}{ }_{7}^{4} \boldsymbol{R}={ }_{4}^{0} \boldsymbol{R}^{-1} \cdot{ }_{7}^{0} \boldsymbol{R}=\left[\begin{array}{ccc}n_{x}^{\prime} & o_{x}^{\prime} & a_{x}^{\prime} \\n_{y}^{\prime} & o_{y}^{\prime} & a_{y}^{\prime} \\n_{z}^{\prime} & o_{z}^{\prime} & a_{z}^{\prime}\end{array}\right]\end{equation}" />

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}{&space;}_{7}^{4}&space;\boldsymbol{R}&space;&={&space;}_{5}^{4}&space;\boldsymbol{R}_{6}^{5}&space;\boldsymbol{R}_{7}^{6}&space;\boldsymbol{R}&space;\\&=\left[\begin{array}{ccc}c_{5}&space;c_{6}&space;c_{7}-s_{5}&space;s_{7}&space;&&space;-c_{5}&space;s_{7}-c_{6}&space;c_{7}&space;s_{5}&space;&&space;c_{5}&space;s_{6}&space;\\c_{7}&space;s_{6}&space;&&space;-s_{7}&space;s_{6}&space;&&space;-c_{6}&space;\\c_{5}&space;s_{7}&plus;c_{6}&space;c_{7}&space;s_{5}&space;&&space;c_{5}&space;c_{7}-s_{5}&space;c_{6}&space;s_{7}&space;&&space;s_{5}&space;s_{6}\end{array}\right]\end{aligned}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}{ }_{7}^{4} \boldsymbol{R} &={ }_{5}^{4} \boldsymbol{R}_{6}^{5} \boldsymbol{R}_{7}^{6} \boldsymbol{R} \\&=\left[\begin{array}{ccc}c_{5} c_{6} c_{7}-s_{5} s_{7} & -c_{5} s_{7}-c_{6} c_{7} s_{5} & c_{5} s_{6} \\c_{7} s_{6} & -s_{7} s_{6} & -c_{6} \\c_{5} s_{7}+c_{6} c_{7} s_{5} & c_{5} c_{7}-s_{5} c_{6} s_{7} & s_{5} s_{6}\end{array}\right]\end{aligned}\end{equation}" />

   Due to the existence of the cosine function, there are two solutions. Introducing variables $GK_3= ±1$ reflect this position

   

   <img src="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}&\theta_{6}=G&space;K_{3}&space;\cdot&space;\arccos&space;\left(-a_{y}^{\prime}\right)&space;\\&\theta_{5}=\operatorname{atan}&space;2\left(\frac{a_{z}^{\prime}}{s_{6}},&space;\frac{a_{x}^{\prime}}{s_{6}}\right)&space;\\&\theta_{7}=\operatorname{atan}&space;2\left(\frac{-o_{y}^{\prime}}{s_{6}},&space;\frac{n_{y}^{\prime}}{s_{6}}\right)\end{aligned}\end{equation}" title="https://latex.codecogs.com/svg.image?\begin{equation}\begin{aligned}&\theta_{6}=G K_{3} \cdot \arccos \left(-a_{y}^{\prime}\right) \\&\theta_{5}=\operatorname{atan} 2\left(\frac{a_{z}^{\prime}}{s_{6}}, \frac{a_{x}^{\prime}}{s_{6}}\right) \\&\theta_{7}=\operatorname{atan} 2\left(\frac{-o_{y}^{\prime}}{s_{6}}, \frac{n_{y}^{\prime}}{s_{6}}\right)\end{aligned}\end{equation}" />

   ## 4. Simulation

   ### 4.1 Model building on Solidworks

   In this project, we choose Solidworks 2021-2022 version to build up URDF model for the whole simulation work for both Matlab and Gazebo. 

   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/9.5jwngtok8m40.webp)
   
   
   
   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/11.63n9lhza23w0.webp)
   
   ### 4.2 Simulation on Gazebo
   
   After we finished building the model in Solidworks, we can import URDF model files to Gazebo through XML file. Here is the simulation effect shown below. 
   
   ![](https://raw.githubusercontent.com/JackTony123/Pichost/master/123/12.ajsicdl6ek0.webp)
   
   
   
   [![WAM Robot Arm Simulation on Gazebo(Demo 1)](https://res.cloudinary.com/marcomontalbano/image/upload/v1652157565/video_to_markdown/images/youtube--dR__jj4YP4I-c05b58ac6eb4c4700831b2b3070cd403.jpg)](https://www.youtube.com/watch?v=dR__jj4YP4I "WAM Robot Arm Simulation on Gazebo(Demo 1)")](https://www.youtube.com/watch?v=dR__jj4YP4I "")
   
   
   
   [![IK Motion Planning Algorithem for WAM 7 DOF Arm(Demo 1)](https://res.cloudinary.com/marcomontalbano/image/upload/v1652158014/video_to_markdown/images/youtube--w6rX2Pm43xM-c05b58ac6eb4c4700831b2b3070cd403.jpg)](https://www.youtube.com/watch?v=w6rX2Pm43xM "IK Motion Planning Algorithem for WAM 7 DOF Arm(Demo 1)")
   
   
   
   
   
   
   
   
   
   
   
   





