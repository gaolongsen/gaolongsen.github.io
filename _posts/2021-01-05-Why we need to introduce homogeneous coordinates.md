---
layout:     post
title:      Why we need to introduce homogeneous coordinates?
subtitle:   
date:       2022-01-05
author:     Longsen Gao
header-img: img/background4.jpg
catalog: 	true
tags:
    - Robot Forward Kinematics
    - DH Parameter
    - Math

---

The translation transformation represents the concept of change of position. The figure below shows that a rectangle is translated from the center point [x1,y1] to the center point [x2,y2] with no change in overall size and angle. The size of tx and ty are translated in the x-direction and y-direction, respectively.

![](http://gaolongsen.github.io/img/why_1png.png)

So we can get obviously that,


<img src="https://latex.codecogs.com/svg.image?\begin{align*}&space;&space;x_2&space;&=&space;x_1&space;&plus;&space;t_x&space;\\&space;&space;y_2&space;&=&space;x_2&space;&plus;&space;t_y&space;\end{align*}" title="\begin{align*} x_2 &= x_1 + t_x \\ y_2 &= x_2 + t_y \end{align*}" />

This holds for every point in the image. Written in matrix form, that can be as

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}&plus;\begin{bmatrix}t_x\\t_y\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}+\begin{bmatrix}t_x\\t_y\end{bmatrix}" />


Here we write out the matrix form of the scaling and rotation transformations as following:

**Scaling Transformation:**

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}k_x&space;&&space;0\\y_2&space;&&space;k_y\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}k_x & 0\\y_2 & k_y\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" />

**Rotation Transformations:**

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}cos\theta&space;&&space;-sin\theta\\sin\theta&space;&&space;cos\theta\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}cos\theta & -sin\theta\\sin\theta & cos\theta\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" />

We note that both the scaling and rotation transformations can be expressed in matrix multiplication. The geometric change is usually not monolithic, which means that regularly scaling, rotating and translating are transformed together. For example, first, zoom in 2 times, then turn 45 degrees, then zoom out 0.5 times. Then it can be expressed in the form of matrix multiplication in series.

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}0.5&space;&&space;0\\0&space;&&space;0.5\end{bmatrix}\begin{bmatrix}cos45&space;&&space;-sin45\\sin45&space;&&space;cos45\end{bmatrix}\begin{bmatrix}2&space;&&space;0\\0&space;&&space;2\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}0.5 & 0\\0 & 0.5\end{bmatrix}\begin{bmatrix}cos45 & -sin45\\sin45 & cos45\end{bmatrix}\begin{bmatrix}2 & 0\\0 & 2\end{bmatrix}\begin{bmatrix}x_1\\y_1\end{bmatrix}" />

Then, can we unify the scaling, rotation and translation transformations into the form of matrix multiplication so that no matter how many times of transformations are performed, they can be expressed as matrix multiplication which will significantly facilitate the calculation and reduce the number of operations.

This method introduces homogeneous coordinates to improve the dimensions that transform the image from flat 2D coordinates to 3D coordinates. Let's look at the matrix form of the translational transformation:

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}&plus;\begin{bmatrix}t_x\\t_y\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}+\begin{bmatrix}t_x\\t_y\end{bmatrix}" />

Improve its dimensions to 3 dimensions as:

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}&space;x_2\\&space;y_2\\&space;1\end{bmatrix}=\begin{bmatrix}1&space;&&space;0&space;&&space;t_x&space;\\0&space;&&space;1&space;&&space;t_y&space;\\0&space;&&space;0&space;&&space;1&space;\\\end{bmatrix}\begin{bmatrix}x_1&space;\\y_1&space;\\1&space;\end{bmatrix}" title="\begin{bmatrix} x_2\\ y_2\\ 1\end{bmatrix}=\begin{bmatrix}1 & 0 & t_x \\0 & 1 & t_y \\0 & 0 & 1 \\\end{bmatrix}\begin{bmatrix}x_1 \\y_1 \\1 \end{bmatrix}" />

The translation transformations are also transformed into matrix multiplication form by improving the dimensions of homogenous coordinates. Of course, the matrix form of the scaling and rotation transformations also has to be changed to a uniform 3-dimensional form.

**Scaling Transformation:**

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2&space;\\1\end{bmatrix}=\begin{bmatrix}1&space;&&space;0&space;&&space;t_x\\0&space;&&space;1&space;&&space;t_y&space;\\0&space;&&space;0&space;&&space;1\end{bmatrix}\begin{bmatrix}x_1\\y_1\\1\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2 \\1\end{bmatrix}=\begin{bmatrix}1 & 0 & t_x\\0 & 1 & t_y \\0 & 0 & 1\end{bmatrix}\begin{bmatrix}x_1\\y_1\\1\end{bmatrix}" />

**Rotation Transformations:**

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2&space;\\1\end{bmatrix}=\begin{bmatrix}cos\theta&space;&&space;-sin\theta&space;&&space;0\\sin\theta&space;&&space;cos\theta&space;&&space;0&space;\\0&space;&&space;0&space;&&space;1\end{bmatrix}\begin{bmatrix}x_1\\y_1\\1\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2 \\1\end{bmatrix}=\begin{bmatrix}cos\theta & -sin\theta & 0\\sin\theta & cos\theta & 0 \\0 & 0 & 1\end{bmatrix}\begin{bmatrix}x_1\\y_1\\1\end{bmatrix}" />
