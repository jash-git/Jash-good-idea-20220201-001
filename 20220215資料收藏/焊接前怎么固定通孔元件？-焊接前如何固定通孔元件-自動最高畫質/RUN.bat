ffmpeg -i 123.flv -s 852x480 -b:v 1024k -vcodec libx264 -r 29.97 -acodec libvo_aacenc -b:a 48k -ac 2 -ar 44100 -profile:v baseline -level 3.0 -f mp4 -y will.mp4