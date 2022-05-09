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

The DH parameter table of the WAM robot arm is shown below

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











