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

- $\theta _{i}$ represents the angle of the x-axis between the coordinate system $\{O_{i-1}\}$ and the coordinate system $\{O_{i}\}$, which is the angle of rotation of $Axis_{i}$ (this is also the angle of rotation of the joint i motor).
- $d_{i}$ represents the offset of the coordinate system $\{O_{i}\}$ with respect to the coordinate system $\{O_{i-1}\}$ in the direction of the $z_{i-1}$ axis.
- $\alpha _{i}$ represents the angle between the actuating shaft and the transmission shaft of $Link_{i}$.
- $a_{i}$ represents the length of $Link_{i}$ in the mathematical sense

From the above description, we can see that 1 and 2 describe the relationship between $Link_{i-1}$ and $Link_{i}$, and 3 and 4 illustrate the intrinsic properties of $Link_{i}$ (because they are only related to $Link_{i}$). So to be clear about DH parameters, it is better to look at these two sets of parameters with different meanings separately..

### 2.2.1 Twist angle and length of connecting rod

We start with the definition of $\alpha _{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha _{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

We start with the definition of $\alpha _{i}$ and $a_{i}$, since these two parameters are more intuitive. The diagram below is a schematic representation of the parameters $\alpha _{i}$ and $a_{i}$ inherent to the connecting rod. Again, the linkage length and twist angle are intrinsic properties of the links themselves and have nothing to do with other links.

![](https://raw.githubusercontent.com/gaolongsen123/Pichost/master/123/liangan2.7h3sh8jojik0.webp)

No matter how complex this link is, we can give a unified description of it: the two joint axes ($Axis_{i}$ and $Axis_{i+1}$) and their common vertical line (circle 1) are the most straightforward abstractions of a link. Here, non-coplanar straight lines have only one common vertical line.

We define the angle between the two non-coplanar straight lines $Axis_{i}$ and $Axis_{i+1}$ as the joint twist angle $\alpha _{i}$ of the connecting rod. The two lines corresponding to the double right slash in the figure are parallel. $\alpha$ is the second parameter in the DH parameter.

### 2.2.2 Connecting rod angle and connecting rod offset

Next, let's look at the definition of the connecting rod angle $\theta _{i}$ and the connecting rod offset $d_{i}$. These two parameters describe a positional relationship. Again, they describe a position relationship between two adjacent connecting rods and no longer the rod's inherent properties. In this case $\theta _{i}$ and $d_{i}$ describe the position relationship of $Link_{i}$ with respect to $Link_{i-1}$.

Returning to Figure 1, $\{O_{i-1}\}$ and $\{O_{i}\}$ are the coordinate systems solidly connected to $Link_{i-1}$ and $Link_{i}$, respectively. By our definition, the x-axis of $\{O_{i-1}\}$ is built on the common vertical line of $Axis_{i-1}$ and $Axis_{i}$, and the x-axis of $\{O_{i}\}$ is built on the common vertical line of $Axis_{i}$ and $Axis_{i+1}$. It shows that the x-axis of $\{O_{i-1}\}$ and the x-axis of $\{O_{i}\}$ are both perpendicular to $Axis_{i}$, which means that $Axis_{i}$ is the common vertical line of the non-coplanar lines $x_{i-1}$ and $x_{i}$.

The two lines corresponding to the single right slash in Figure 1 are parallel, then $\theta_{i}$ corresponds to the angle between the lines $x_{i-1}$ and $x_{i}$. Therefore, we define the angle between the x-axis of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the connecting rod turning angle $\theta_{i}$.

We find that the x-axis of $\{O_{i-1}\}$ is parallel to the x-axis of $\{O_{i}\}$ after $\{O_{i-1}\} rotate $\theta _{i}$ degrees along $Axis_{i}$ (i.e. the z-axis of $\{O_{i-1}\}$)! We define the length of the common vertical line between the x-axes of $\{O_{i-1}\}$ and $\{O_{i}\}$ as the rod offset $d_{i}$.



