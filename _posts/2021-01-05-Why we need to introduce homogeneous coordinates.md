# Why we need to introduce homogeneous coordinates?

The translation transformation represents the concept of change of position. The figure below shows that a rectangle is translated from the center point [x1,y1] to the center point [x2,y2] with no change in overall size and angle. The size of tx and ty are translated in the x-direction and y-direction, respectively.

![](https://img-blog.csdn.net/20180324175922438?watermark/2/text/aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L3NhbHRyaXZlcg==/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70)

So we can get obviously that,
<<<<<<< HEAD
$$
x_2=x_1+t_x\\y_2=x_2+t_y
$$

This holds for every point in the image. Written in matrix form, that can be as

<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}&plus;\begin{bmatrix}t_x\\t_y\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}+\begin{bmatrix}t_x\\t_y\end{bmatrix}" />
$$
\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}+\begin{bmatrix}t_x\\t_y\end{bmatrix}
$$
=======
$$x_2 = x_1 + t_x \\ y_2 = x_2 + t_y$$
This holds for every point in the image. Written in matrix form, that can be as
<img src="https://latex.codecogs.com/svg.image?\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}&plus;\begin{bmatrix}t_x\\t_y\end{bmatrix}" title="\begin{bmatrix}x_2\\y_2\end{bmatrix}=\begin{bmatrix}x_1\\y_1\end{bmatrix}+\begin{bmatrix}t_x\\t_y\end{bmatrix}" />
>>>>>>> ee740ed09f42871301c53f092d5c64422a2da272
Here we write out the matrix form of the scaling and rotation transformations as following:

**Scaling Transformation:**
$$
\begin{bmatrix}
x_2\\
y_2
\end{bmatrix}
=
\begin{bmatrix}
k_x & 0\\
y_2 & k_y
\end{bmatrix}

\begin{bmatrix}
x_1\\
y_1
\end{bmatrix}
$$
**Rotation Transformations:**
$$
\begin{bmatrix}
x_2\\
y_2
\end{bmatrix}
=
\begin{bmatrix}
cos\theta & -sin\theta\\
sin\theta & cos\theta
\end{bmatrix}

\begin{bmatrix}
x_1\\
y_1
\end{bmatrix}
$$
We note that both the scaling and rotation transformations can be expressed in matrix multiplication. The geometric change is usually not monolithic, which means that regularly scaling, rotating and translating are transformed together. For example, first, zoom in 2 times, then turn 45 degrees, then zoom out 0.5 times. Then it can be expressed in the form of matrix multiplication in series.
$$
\begin{bmatrix}
x_2\\
y_2
\end{bmatrix}
=
\begin{bmatrix}
0.5 & 0\\
0 & 0.5
\end{bmatrix}
\begin{bmatrix}
cos45 & -sin45\\
sin45 & cos45
\end{bmatrix}
\begin{bmatrix}
2 & 0\\
0 & 2
\end{bmatrix}
\begin{bmatrix}
x_1\\
y_1
\end{bmatrix}
$$
Then, can we unify the scaling, rotation and translation transformations into the form of matrix multiplication so that no matter how many times of transformations are performed, they can be expressed as matrix multiplication which will significantly facilitate the calculation and reduce the number of operations.

This method introduces homogeneous coordinates to improve the dimensions that transform the image from flat 2D coordinates to 3D coordinates. Let's look at the matrix form of the translational transformation:
$$
\begin{bmatrix}
x_2\\
y_2
\end{bmatrix}
=
\begin{bmatrix}
x_1\\
y_1
\end{bmatrix}
+
\begin{bmatrix}
t_x\\
t_y
\end{bmatrix}
$$
Improve its dimensions to 3 dimensions as:
$$
\begin{bmatrix}
x_2\\
y_2 \\
1
\end{bmatrix}
=
\begin{bmatrix}
1 & 0 & t_x\\
0 & 1 & t_y \\
0 & 0 & 1
\end{bmatrix}
\begin{bmatrix}
x_1\\
y_1\\
1
\end{bmatrix}
$$
The translation transformations are also transformed into matrix multiplication form by improving the dimensions of homogenous coordinates. Of course, the matrix form of the scaling and rotation transformations also has to be changed to a uniform 3-dimensional form.

**Scaling Transformation:**
$$
\begin{bmatrix}
x_2\\
y_2 \\
1
\end{bmatrix}
=
\begin{bmatrix}
k_x & 0 & 0\\
0 & k_y & 0 \\
0 & 0 & 1
\end{bmatrix}
\begin{bmatrix}
x_1\\
y_1\\
1
\end{bmatrix}
$$
**Rotation Transformations:**
$$
\begin{bmatrix}
x_2\\
y_2 \\
1
\end{bmatrix}
=
\begin{bmatrix}
cos\theta & -sin\theta & 0\\
sin\theta & cos\theta & 0 \\
0 & 0 & 1
\end{bmatrix}
\begin{bmatrix}
x_1\\
y_1\\
1
\end{bmatrix}
$$
