import pcl
import pcl.pcl_visualization


# 深度、顏色轉換爲點雲
def DepthColor2Cloud(points_3d, colors):
    rows, cols = points_3d.shape[0:2]

    size = rows * cols
    points_ = points_3d.reshape(size, 3).astype(np.int16)
    colors_ = colors.reshape(size, 3).astype(np.int64)


    # 顏色信息
    blue = colors_[:, 0].reshape(size, 1)
    green = colors_[:, 1].reshape(size, 1)
    red = colors_[:, 2].reshape(size, 1)

    rgb = np.left_shift(blue, 0) + np.left_shift(green, 8) + np.left_shift(red, 16)

    # 將座標+顏色疊加爲點雲數組
    points = np.hstack((points_, rgb)).astype(np.float32)

    return points



# 點雲顯示
def view_cloud(points, colors):
    cloud = DepthColor2Cloud(points, colors)
    cloud = pcl.PointCloud_PointXYZRGB()
    cloud.from_array(points)

    try:
        visual = pcl.pcl_visualization.CloudViewing()
        visual.ShowColorACloud(cloud)
        v = True
        while v:
            v = not(visual.WasStopped())
    except:
        pass
